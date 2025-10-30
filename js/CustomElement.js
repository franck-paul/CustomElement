class DotclearRest {
  // REST services helper
  constructor() {
    this.servicesUri = 'index.php?rest&';
  }

  run(
    fn, // REST method
    onSuccess = (_data) => {
      // Used when fetch is successful
    },
    onError = (_error) => {
      // Used when fetch failed
      console.log(_error);
    },
    params = {}, // Optional parameters
  ) {
    const service = new URL(this.servicesUri, globalThis.location.origin + globalThis.location.pathname);

    // Add REST requested function to parameters
    params.f = fn;

    // Add parameters to query part of URL
    const data = new URLSearchParams(params);
    service.search = service.search + data.toString();

    fetch(service, { method: 'GET' })
      .then((promise) => {
        if (!promise.ok) {
          throw new Error(promise.statusText);
        }
        // Return a promise of text representation of body -> response
        return promise.text();
      })
      .then((response) => onSuccess(response))
      .catch((error) => onError(error));
  }
}

class DotclearReleaseStableVersion extends HTMLElement {
  constructor() {
    super();

    // Get info via REST method
    const service = new DotclearRest();
    if (service) {
      service.run(
        'getReleaseStableVersion',
        (data) => {
          // JSON decode response
          const response = JSON.parse(data);
          if (response?.success) {
            // REST call ok
            if (response?.payload.ret) {
              // REST function call ok
              const shadow = this.attachShadow({ mode: 'open' });
              const span = document.createElement('span');
              span.textContent = response.payload.text;
              shadow.appendChild(span);
            }
          }
        },
        (_error) => {}, // Ignore errors
        { json: 1 }, // Use JSON format
      );
    }
  }
}

customElements.define('dotclear-release-stable-version', DotclearReleaseStableVersion);
