document.addEventListener("DOMContentLoaded", function () {
  // Russian phone number mask: +7 (XXX) XXX-XX-XX
  function applyPhoneMask(input) {
    let value = input.value.replace(/\D/g, ''); // Remove all non-digits
    
    // If the number starts with 8, replace it with 7
    if (value.startsWith('8')) {
      value = '7' + value.slice(1);
    }
    
    // If the number starts with 7, format it
    if (value.startsWith('7')) {
      value = value.slice(1); // Remove the 7 as we'll add +7 prefix
    }
    
    // Limit to 10 digits (after +7)
    value = value.slice(0, 10);
    
    // Format the number
    let formattedValue = '+7';
    
    if (value.length > 0) {
      formattedValue += ' (' + value.slice(0, 3);
    }
    if (value.length >= 4) {
      formattedValue += ') ' + value.slice(3, 6);
    }
    if (value.length >= 7) {
      formattedValue += '-' + value.slice(6, 8);
    }
    if (value.length >= 9) {
      formattedValue += '-' + value.slice(8, 10);
    }
    
    input.value = formattedValue;
  }

  function handlePhoneInput(e) {
    const input = e.target;
    
    // Store cursor position
    const cursorPosition = input.selectionStart;
    const previousLength = input.value.length;
    
    applyPhoneMask(input);
    
    // Adjust cursor position after formatting
    const newLength = input.value.length;
    const lengthDiff = newLength - previousLength;
    let newCursorPosition = cursorPosition + lengthDiff;
    
    // Ensure cursor doesn't go before the +7 prefix
    if (newCursorPosition < 2) {
      newCursorPosition = input.value.length;
    }
    
    // Set cursor position
    setTimeout(() => {
      input.setSelectionRange(newCursorPosition, newCursorPosition);
    }, 0);
  }

  function handlePhoneKeydown(e) {
    const input = e.target;
    
    // Allow: backspace, delete, tab, escape, enter
    if ([8, 9, 27, 13, 46].indexOf(e.keyCode) !== -1 ||
        // Allow: Ctrl+A, Ctrl+C, Ctrl+V, Ctrl+X
        (e.keyCode === 65 && e.ctrlKey === true) ||
        (e.keyCode === 67 && e.ctrlKey === true) ||
        (e.keyCode === 86 && e.ctrlKey === true) ||
        (e.keyCode === 88 && e.ctrlKey === true) ||
        // Allow: home, end, left, right
        (e.keyCode >= 35 && e.keyCode <= 39)) {
      return;
    }
    
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
      e.preventDefault();
    }
    
    // Don't allow editing the +7 prefix
    if (input.selectionStart < 2 && [8, 46].indexOf(e.keyCode) !== -1) {
      e.preventDefault();
    }
  }

  function handlePhoneFocus(e) {
    const input = e.target;
    if (input.value === '' || input.value === '+7') {
      input.value = '+7 (';
    }
  }

  function initializePhoneMasks() {
    // Find all phone input fields in Contact Form 7 forms
    const phoneInputs = document.querySelectorAll(
      'input[type="tel"], ' +
      '.rfc-trial-form__input-phone, ' +
      '.callback-modal__form input[type="text"][name*="phone"], ' +
      '.callback-modal__form input[type="tel"], ' +
      '.registration-modal__form input[type="text"][name*="phone"], ' +
      '.registration-modal__form input[type="tel"], ' +
      '.wpcf7-form input[type="tel"], ' +
      '.wpcf7-form input[name*="phone"], ' +
      '.wpcf7-form input[name*="Phone"], ' +
      '.wpcf7-form input[name*="телефон"]'
    );

    phoneInputs.forEach(function(input) {
      // Set initial value if empty
      if (input.value === '') {
        input.value = '+7 (';
      } else if (input.value && !input.value.startsWith('+7')) {
        // Format existing value
        applyPhoneMask(input);
      }
      
      // Add event listeners
      input.addEventListener('input', handlePhoneInput);
      input.addEventListener('keydown', handlePhoneKeydown);
      input.addEventListener('focus', handlePhoneFocus);
      
      // Set placeholder
      input.setAttribute('placeholder', '+7 (XXX) XXX-XX-XX');
    });
  }

  // Initialize on page load
  initializePhoneMasks();

  // Re-initialize when Contact Form 7 forms are loaded via AJAX
  document.addEventListener('wpcf7mailsent', function() {
    setTimeout(initializePhoneMasks, 100);
  });

  // Re-initialize when modals are opened
  document.addEventListener('click', function(e) {
    if (e.target.matches('.open-registration-form, .open-callback-form')) {
      setTimeout(initializePhoneMasks, 300);
    }
  });

  // Mutation observer for dynamically loaded content
  if (window.MutationObserver) {
    const observer = new MutationObserver(function(mutations) {
      mutations.forEach(function(mutation) {
        if (mutation.addedNodes.length > 0) {
          initializePhoneMasks();
        }
      });
    });

    observer.observe(document.body, {
      childList: true,
      subtree: true
    });
  }
}); 