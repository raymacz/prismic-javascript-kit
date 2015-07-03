(function(global) {

    // -- QueryString parser

    var parseQS = function(query) {
        var params = {},
            match,
            pl = /\+/g,
            search = /([^&=]+)=?([^&]*)/g,
            decode = function (s) { return decodeURIComponent(s.replace(pl, " ")); };
        while (match = search.exec(query)) {
           params[decode(match[1])] = decode(match[2]);
        }
        return params;
    }

    // -- Prismic Helpers

    global.Helpersz = {

        getApiHome: function(callback) {
            var xxx=Prismic.Api(Configuration.apiEndpoint, callback, Configuration.accessToken);
            return  xxx;
        },

        buildContext: function(ref, callback) {
          // retrieve the API
          global.Helpersz.getApiHome(function(err, api, xhr) {
            if (err) { Configuration.onPrismicError(err, xhr); return; }
            var experimentCookie = prismic.startExperiment ? prismic.utils.docCookies.getItem('io.prismic.experiment') : null;
            var experimentRef = experimentCookie ? api.experiments.refFromCookie(experimentCookie) : null;
            var ctx = {
              ref: (ref || experimentRef || api.data.master.ref),
              api: api,
              maybeRef: (ref && ref != api.data.master.ref ? ref : ''),
              maybeRefParam: (ref && ref != api.data.master.ref ? '&ref=' + ref : ''),

              oauth: function() {
                var token = sessionStorage.getItem('ACCESS_TOKEN');
                return {
                  accessToken: token,
                  hasPrivilegedAccess: !!token
                }
              },

              linkResolver: function(ctx, doc) {
                return Configuration.linkResolver(ctx, doc);
              }
            }
            callback(ctx);
          });
        },

        getOauthInitiate: function(callback) {
          global.Helpersz.getApiHome(function(err, api, xhr) {
              if(err) {
                  var response = JSON.parse(xhr.responseText);
                  callback && callback(null, response.oauth_initiate);
              } else {
                  callback && callback(null, api.data.oauthInitiate);
              }
          });
        },

        withPrismic: function(callback) {
            global.Helpersz.buildContext(global.Helpersz.queryString['ref'], function(ctx) {
                callback.apply(window, [ctx]);
            });
            
            
        },
        
        ///----------
        testwithPrismic: function(callback) {
            global.Helpersz.buildContext(global.Helpersz.queryString['ref'], function(ctx) {
                callback.apply(window, [ctx]);
            });
            
            
        },
        ///---------

        // QueryString data
        queryString: parseQS(window.location.search.substring(1)),

        // Hash data
        encodedHash: parseQS(window.location.hash.substring(1)),

        loadExperimentJs: function(googleId) {
          if (googleId == "null") return;
          var loadJs = function(url, callback) {
            var head = document.getElementsByTagName('head')[0],
                script = document.createElement('script'),
                loaded = false;
            script.onload = script.onreadystatechange = function() {
              if(!loaded && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) {
                loaded = true;
                callback();
                script.onload = script.onreadystatechange = null;
                head.removeChild(script);
              };
            };
            script.src = url;
            head.appendChild(script);
          };
          loadJs("//www.google-analytics.com/cx/api.js?experiment=" + googleId, function() {
            prismic.startExperiment(googleId, cxApi);
          });
        }

    };

}(window));
