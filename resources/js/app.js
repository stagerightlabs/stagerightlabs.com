import 'alpinejs';
import Sortable from '@shopify/draggable/lib/sortable'

// https://inspiredwebdev.com/copy-to-clipboard-with-javascript
window.copyToClipboard = function(text) {
  const el = document.createElement('textarea');
  el.value = text;
  el.setAttribute('readonly', '');
  el.style.position = 'absolute';
  el.style.left = '-9999px';
  document.body.appendChild(el);
  el.select();
  document.execCommand('copy');
  document.body.removeChild(el);
}

// Custom livewire sortable directive based on https://github.com/livewire/sortable
// Updated to adjust mirror configuration and add additional classes
// based on drag state.
window.livewire.directive('sortable', (el, directive, component) => {
    // Only fire this handler on the "root" directive.
    if (directive.modifiers.length > 0) return

    let options = {
      draggable: '[wire\\:sortable\\.item]',
      classes: {
        'draggable:over': ['draggable--over'],
      }
    }

    // Should we constrain the dimensions of the mirror element?
    if (el.hasAttribute('wire:sortable.mirror.constrain')) {
        options.mirror = options.mirror || {}
        options.mirror.constrainDimensions = true
    }

    // Have any classes been specified for the 'draggable:over' element?
    if (el.getAttribute('wire:sortable.classes.over')) {
      options.classes['draggable:over'] = options.classes['draggable:over'].concat(
        el.getAttribute('wire:sortable.classes.over').split(' ')
      )
    }

    // Define the draggable handle if it has been specified
    if (el.querySelector('[wire\\:sortable\\.handle]')) {
        options.handle ='[wire\\:sortable\\.handle]'
    }

    const sortable = new Sortable(el, options);

    sortable.on('sortable:stop', () => {
        setTimeout(() => {
            let items = []

            el.querySelectorAll('[wire\\:sortable\\.item]').forEach((el, index) => {
                items.push({ order: index + 1, value: el.getAttribute('wire:sortable.item')})
            })

            component.call(directive.method, items)
        }, 1)
    })
})
