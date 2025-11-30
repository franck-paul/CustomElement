class DotclearRest {
  // REST services helper (XML/JSON, GET method only)
  servicesUri = 'index.php?rest&';

  constructor() {
    const getData = (id) => {
      const element = document.getElementById(`${id}-data`);
      if (element) {
        try {
          return JSON.parse(element.textContent);
        } catch (e) {
          console.log(e);
        }
      }
      return {};
    };

    this.servicesUri = getData('custom-element').uri;
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
    service.search += data.toString();

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

class DotclearRestFetch {
  constructor(fn) {
    this.fn = fn;
  }

  run(element) {
    // Get info via REST method
    const service = new DotclearRest();
    if (service) {
      service.run(
        this.fn,
        (data) => {
          // JSON decode response
          const response = JSON.parse(data);
          if (!(response?.success && response?.payload.ret)) {
            return;
          }
          // REST function call ok
          const shadow = element.attachShadow({ mode: 'open' });
          const span = document.createElement('span');
          span.textContent = response.payload.text;
          shadow.appendChild(span);
        },
        (_error) => {}, // Ignore errors
        { json: 1 }, // Use JSON format
      );
    }
  }
}

class DotclearReleaseStableVersion extends HTMLElement {
  constructor() {
    super();

    new DotclearRestFetch('getReleaseStableVersion').run(this);
  }
}

class DotclearReleaseStablePhpMin extends HTMLElement {
  constructor() {
    super();

    new DotclearRestFetch('getReleaseStablePhpMin').run(this);
  }
}

class DotclearNextRequiredPhp extends HTMLElement {
  constructor() {
    super();

    new DotclearRestFetch('getNextRequiredPhp').run(this);
  }
}

customElements.define('dotclear-release-stable-version', DotclearReleaseStableVersion);
customElements.define('dotclear-release-stable-phpmin', DotclearReleaseStablePhpMin);
customElements.define('dotclear-next-required-php', DotclearNextRequiredPhp);
