document.addEventListener("DOMContentLoaded", function () {
  if (!window.smartCaptcha) {
    return;
  }

  const widgets = new Map(); // form -> { widgetId, tokenInput, verified }

  function resetWidget(event) {
    const state = widgets.get(event.currentTarget);
    if (!state) {
      return;
    }

    window.smartCaptcha.reset(state.widgetId);
    state.tokenInput.value = "";
  }

  function initWidget(container) {
    const form = container.closest("form");
    if (!form || widgets.has(form)) {
      return;
    }

    const tokenInput = document.createElement("input");
    tokenInput.type = "hidden";
    tokenInput.name = "smart-token";
    form.appendChild(tokenInput);

    const state = { widgetId: null, tokenInput, verified: false };
    widgets.set(form, state);

    state.widgetId = window.smartCaptcha.render(container, {
      sitekey: container.dataset.sitekey,
      invisible: true,
      hideShield: true,
      callback: function (token) {
        tokenInput.value = token;
        state.verified = true;
        // requestSubmit() re-fires the "submit" event (unlike form.submit()),
        // so Contact Form 7's own AJAX handler still picks it up
        form.requestSubmit ? form.requestSubmit() : form.submit();
      },
    });

    // Capture phase runs before CF7's own bubble-phase submit handler, so we
    // can hold the AJAX submission until a SmartCaptcha token is ready
    form.addEventListener(
      "submit",
      function (event) {
        if (state.verified) {
          state.verified = false;
          return;
        }

        if (form.checkValidity && !form.checkValidity()) {
          return;
        }

        event.preventDefault();
        event.stopImmediatePropagation();
        window.smartCaptcha.execute(state.widgetId);
      },
      true
    );

    form.addEventListener("wpcf7mailsent", resetWidget);
    form.addEventListener("wpcf7invalid", resetWidget);
    form.addEventListener("wpcf7mailfailed", resetWidget);
    form.addEventListener("wpcf7spam", resetWidget);
  }

  document.querySelectorAll(".smart-captcha").forEach(initWidget);
});
