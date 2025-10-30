class DotclearRest {
  // REST services helper
  constructor() {
    this.servicesUri = 'index.php?custom';
  }

  /**
   * Call REST service function
   *
   * @param      {string}            fn                                          The REST function name
   * @param      {Function}          [onSuccess=(_data)=>{}]                     On success
   * @param      {Function}          [onError=(_error)=>{console.log(_error);}]  On error
   * @param      {(boolean|string)}  [get=true]                                  True if GET, false if POST method
   * @param      {Object}            [params={}]                                 The parameters
   */
  run(
    fn, // REST method
    onSuccess = (_data) => {
      // Used when fetch is successful
    },
    onError = (_error) => {
      // Used when fetch failed
      console.log(_error);
    },
    get = true, // Use GET method if true, POST if false
    params = {}, // Optional parameters
  ) {
    const service = new URL(this.servicesUri, globalThis.location.origin + globalThis.location.pathname);
    dotclear.mergeDeep(params, { f: fn });
    const init = { method: get ? 'GET' : 'POST' };
    // Cope with parameters
    // --------------------
    // Warning: cope only with single level object (key → value)
    // Use JSON.stringify to push complex object in Javascript
    // Use json_decode(, [true]) to decode complex object in PHP (use true as 2nd param if key-array)
    if (get) {
      // Add parameters to query part of URL
      const data = new URLSearchParams(service.search);
      for (const key of Object.keys(params)) data.append(key, params[key]);
      service.search = data.toString();
    } else {
      // Add parameters to body part of request
      const data = new FormData();
      for (const key of Object.keys(params)) data.append(key, params[key]);
      init.body = data;
    }
    fetch(service, init)
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
          if (data.ret === true) {
            // Création d’un Shadow DOM pour isoler le contenu
            const shadow = this.attachShadow({ mode: 'open' });
            // Création de l'élément à ajouter
            const span = document.createElement('span');
            span.textContent = data.text;
            shadow.appendChild(span);
          }
        },
        (_error) => {}, // Ignore errors
        { json: true }, // Use JSON format
      );
    }
  }
}

customElements.define('dotclear-release-stable-version', DotclearReleaseStableVersion);
