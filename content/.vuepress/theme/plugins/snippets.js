const { fs, path } = require('@vuepress/shared-utils')
const { removePlugin } = require('@vuepress/markdown')
const { PLUGINS } = require('@vuepress/markdown/lib/constant')

module.exports = (options = {}) =>  {

  // Determine the appropriate root file path
  const root = options.root || process.cwd()

  // Scan markdown files for the custom fence block ("~~~") and register tokens
  // to be processed by the custom snippet rule.
  // Borrowed largely from
  // https://github.com/vuejs/vuepress/blob/master/packages/%40vuepress/markdown/lib/snippet.js
  function parser (state, startLine, endLine, silent) {
    const CH = '~'.charCodeAt(0)
    const pos = state.bMarks[startLine] + state.tShift[startLine]
    const max = state.eMarks[startLine]

    // if it's indented more than 3 spaces, it should be a code block
    if (state.sCount[startLine] - state.blkIndent >= 4) {
      return false
    }

    // The symbol must be three characters long
    for (let i = 0; i < 3; ++i) {
      const ch = state.src.charCodeAt(pos + i)
      if (ch !== CH || pos + i >= max) return false
    }

    // If the silent parameter is true, we can abort now
    if (silent) {
      return true
    }

    // Extract the full path of the snippet file from the symbol
    const start = pos + 3
    const end = state.skipSpacesBack(max, pos)
    const rawPath = state.src.slice(start, end).trim().replace(/^@/, root)
    const filePath = rawPath.split(/[{\s]/).shift()

    // Tell the markdown parser to move to the next line
    state.line = startLine + 1

    // Push a new token into the global token array
    const token = state.push('snippet', 'code', 1)
    token.src = path.resolve(filePath)
    token.map = [startLine, startLine + 1]
    token.meta = extractMetaData(rawPath.replace(filePath, ''))

    // Returning true tells the markdown parser all is well
    // and it can continue parsing
    return true
  }

  // We receive the meta string in this format: "{lineNumber,filename,url}"
  // We want to remove the prefix "{" and suffix "}" and extract
  // the content as values.
  function extractMetaData(meta) {

    let [lineNumber, filename, url] = meta
      .substring(0, meta.length - 1)
      .substring(1)
      .split(',')

    lineNumber = lineNumber.length ? parseInt(lineNumber) : undefined;

    return {lineNumber, filename, url}
  }

  // Use the contents of the snippet file and the meta data to
  // construct a table containing our embedded snippet code
  function renderTable(contents, meta = {}) {
    // Split the file contents into an array of lines
    const lines = contents.split("\n");

    // Ensure we have content to work with
    if (lines.length == 0) {
      return '';
    }

    // If the last line is empty, remove it
    if (lines[lines.length - 1] == '') {
      lines.pop();
    }

    // Prepare to build our table
    let lineNumber = meta.lineNumber || 1;
    let table = `<div class="snippet"><table><tbody>`

    // Loop through each line and add it to the table as a new row
    // We use v-pre here to prevent the contents from being
    // interpreted by the client-side vue instance
    lines.forEach((line) => {
      table += `<tr><td class="line-number">${lineNumber}</td><td class="code-content" v-pre>${escapeHtml(line)}</td></tr>`
      lineNumber = lineNumber + 1;
    });

    // Close the table
    table += `</tbody></table>`;

    // If a file name was provided, we will display it at the bottom of the table
    if (meta.filename) {
      table += `<div class="filename">`
      table += meta.url
        ? `<a href="${meta.url}" target="_blank">${escapeHtml(meta.filename)}</a>`
        : `${escapeHtml(meta.filename)}`
      table += `</div>`
    }

    // Close our table and return the html string
    return table += `</div>`;
  }

  // Escape html entities as needed
  // https://stackoverflow.com/a/6234804
  function escapeHtml (unsafe) {
    return unsafe
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "&#039;")
      .replace(/{/g, "&lbrace;")
      .replace(/}/g, "&rbrace;");
  }

  // Export an object that describes the functionality of our plugin
  return {
    // The name of the plugin
    name: 'custom-snippets',
    // Disable the default snippet plugin
    chainMarkdown (config) {
      removePlugin(config, PLUGINS.SNIPPET)
    },
    // This method is a hook that lets us manipulate the markdown parser
    extendMarkdown: md => {

      // Retrieve the 'fence' code block renderer from the markdown parser
      const fence = md.renderer.rules.fence

      // Register a new render rule that will convert our custom token into an html table
      md.renderer.rules.snippet = (...args) => {
        const [tokens, idx, , ] = args
        const token = tokens[idx]
        const { src } = token
        if (src) {
          // Read the file contents and generate our table
          if (fs.existsSync(src)) {
            return renderTable(fs.readFileSync(src, 'utf8'), token.meta)
          }
          // Display a warning if the file does not exist
          token.content = 'Not found: ' + src
          token.info = ''
          return fence(...args)
        }
      }
      // Ask the markdown parser to run the custom rule prior to the 'fence' rule
      md.block.ruler.before('fence', 'snippet', parser)
    }
  }
}
