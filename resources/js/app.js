import Alpine from 'alpinejs'
import Sortable from 'sortablejs'

// https://inspiredwebdev.com/copy-to-clipboard-with-javascript
window.copyToClipboard = function (text) {
  const el = document.createElement('textarea')
  el.value = text
  el.setAttribute('readonly', '')
  el.style.position = 'absolute'
  el.style.left = '-9999px'
  document.body.appendChild(el)
  el.select()
  document.execCommand('copy')
  document.body.removeChild(el)
}

// Sortable directive
Alpine.directive('sortable', (el, { expression }, { cleanup, evaluate }) => {
  const exp = evaluate(expression)

  const sortable = Sortable.create(el, {
    handle: exp.handle ?? null,
    onEnd () {
      setTimeout(() => {
        // Create a payload array that indicates the new sort order
        const items = []
        el.querySelectorAll('[x-sortable-id]').forEach((el, index) => {
          items.push({ order: index + 1, value: el.getAttribute('x-sortable-id') })
        })

        // Send the change to the server
        if (exp.end && exp.livewire) {
          exp.livewire.call(exp.end, items)
        }
      }, 1)
    }
  })

  cleanup(() => {
    sortable.destroy()
  })
})

// Initialize Apline.js
window.Alpine = Alpine
Alpine.start()
