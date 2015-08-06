/*!
 * SURF InContext RDF visualizer
 * 
 * Copyright 2011  SURFfoundation
 * Licensed under the GPL version 3 license.
 * See below for the license statements of included dependencies.
 *
 * For more information see: http://code.google.com/p/surf-incontext/
 * 
 * Build date: 2011-06-15 13:03:42
 */

(function() {

/*!
* jQuery JavaScript Library v1.4.4
* http://jquery.com/
*
* Copyright 2010, John Resig
* Dual licensed under the MIT or GPL Version 2 licenses.
* http://jquery.org/license
*
* Includes Sizzle.js
* http://sizzlejs.com/
* Copyright 2010, The Dojo Foundation
* Released under the MIT, BSD, and GPL Licenses.
*
* Date: Thu Nov 11 19:04:53 2010 -0500
*/
(function (window, undefined) {

  // Use the correct document accordingly with window argument (sandbox)
  var document = window.document;
  var jQuery = (function () {

    // Define a local copy of jQuery
    var jQuery = function (selector, context) {
      // The jQuery object is actually just the init constructor 'enhanced'
      return new jQuery.fn.init(selector, context);
    },

    // Map over jQuery in case of overwrite
	_jQuery = window.jQuery,

    // Map over the $ in case of overwrite
	_$ = window.$,

    // A central reference to the root jQuery(document)
	rootjQuery,

    // A simple way to check for HTML strings or ID strings
    // (both of which we optimize for)
	quickExpr = /^(?:[^<]*(<[\w\W]+>)[^>]*$|#([\w\-]+)$)/,

    // Is it a simple selector
	isSimple = /^.[^:#\[\.,]*$/,

    // Check if a string has a non-whitespace character in it
	rnotwhite = /\S/,
	rwhite = /\s/,

    // Used for trimming whitespace
	trimLeft = /^\s+/,
	trimRight = /\s+$/,

    // Check for non-word characters
	rnonword = /\W/,

    // Check for digits
	rdigit = /\d/,

    // Match a standalone tag
	rsingleTag = /^<(\w+)\s*\/?>(?:<\/\1>)?$/,

    // JSON RegExp
	rvalidchars = /^[\],:{}\s]*$/,
	rvalidescape = /\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g,
	rvalidtokens = /"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g,
	rvalidbraces = /(?:^|:|,)(?:\s*\[)+/g,

    // Useragent RegExp
	rwebkit = /(webkit)[ \/]([\w.]+)/,
	ropera = /(opera)(?:.*version)?[ \/]([\w.]+)/,
	rmsie = /(msie) ([\w.]+)/,
	rmozilla = /(mozilla)(?:.*? rv:([\w.]+))?/,

    // Keep a UserAgent string for use with jQuery.browser
	userAgent = navigator.userAgent,

    // For matching the engine and version of the browser
	browserMatch,

    // Has the ready events already been bound?
	readyBound = false,

    // The functions to execute on DOM ready
	readyList = [],

    // The ready event handler
	DOMContentLoaded,

    // Save a reference to some core methods
	toString = Object.prototype.toString,
	hasOwn = Object.prototype.hasOwnProperty,
	push = Array.prototype.push,
	slice = Array.prototype.slice,
	trim = String.prototype.trim,
	indexOf = Array.prototype.indexOf,

    // [[Class]] -> type pairs
	class2type = {};

    jQuery.fn = jQuery.prototype = {
      init: function (selector, context) {
        var match, elem, ret, doc;

        // Handle $(""), $(null), or $(undefined)
        if (!selector) {
          return this;
        }

        // Handle $(DOMElement)
        if (selector.nodeType) {
          this.context = this[0] = selector;
          this.length = 1;
          return this;
        }

        // The body element only exists once, optimize finding it
        if (selector === "body" && !context && document.body) {
          this.context = document;
          this[0] = document.body;
          this.selector = "body";
          this.length = 1;
          return this;
        }

        // Handle HTML strings
        if (typeof selector === "string") {
          // Are we dealing with HTML string or an ID?
          match = quickExpr.exec(selector);

          // Verify a match, and that no context was specified for #id
          if (match && (match[1] || !context)) {

            // HANDLE: $(html) -> $(array)
            if (match[1]) {
              doc = (context ? context.ownerDocument || context : document);

              // If a single string is passed in and it's a single tag
              // just do a createElement and skip the rest
              ret = rsingleTag.exec(selector);

              if (ret) {
                if (jQuery.isPlainObject(context)) {
                  selector = [document.createElement(ret[1])];
                  jQuery.fn.attr.call(selector, context, true);

                } else {
                  selector = [doc.createElement(ret[1])];
                }

              } else {
                ret = jQuery.buildFragment([match[1]], [doc]);
                selector = (ret.cacheable ? ret.fragment.cloneNode(true) : ret.fragment).childNodes;
              }

              return jQuery.merge(this, selector);

              // HANDLE: $("#id")
            } else {
              elem = document.getElementById(match[2]);

              // Check parentNode to catch when Blackberry 4.6 returns
              // nodes that are no longer in the document #6963
              if (elem && elem.parentNode) {
                // Handle the case where IE and Opera return items
                // by name instead of ID
                if (elem.id !== match[2]) {
                  return rootjQuery.find(selector);
                }

                // Otherwise, we inject the element directly into the jQuery object
                this.length = 1;
                this[0] = elem;
              }

              this.context = document;
              this.selector = selector;
              return this;
            }

            // HANDLE: $("TAG")
          } else if (!context && !rnonword.test(selector)) {
            this.selector = selector;
            this.context = document;
            selector = document.getElementsByTagName(selector);
            return jQuery.merge(this, selector);

            // HANDLE: $(expr, $(...))
          } else if (!context || context.jquery) {
            return (context || rootjQuery).find(selector);

            // HANDLE: $(expr, context)
            // (which is just equivalent to: $(context).find(expr)
          } else {
            return jQuery(context).find(selector);
          }

          // HANDLE: $(function)
          // Shortcut for document ready
        } else if (jQuery.isFunction(selector)) {
          return rootjQuery.ready(selector);
        }

        if (selector.selector !== undefined) {
          this.selector = selector.selector;
          this.context = selector.context;
        }

        return jQuery.makeArray(selector, this);
      },

      // Start with an empty selector
      selector: "",

      // The current version of jQuery being used
      jquery: "1.4.4",

      // The default length of a jQuery object is 0
      length: 0,

      // The number of elements contained in the matched element set
      size: function () {
        return this.length;
      },

      toArray: function () {
        return slice.call(this, 0);
      },

      // Get the Nth element in the matched element set OR
      // Get the whole matched element set as a clean array
      get: function (num) {
        return num == null ?

        // Return a 'clean' array
			this.toArray() :

        // Return just the object
			(num < 0 ? this.slice(num)[0] : this[num]);
      },

      // Take an array of elements and push it onto the stack
      // (returning the new matched element set)
      pushStack: function (elems, name, selector) {
        // Build a new jQuery matched element set
        var ret = jQuery();

        if (jQuery.isArray(elems)) {
          push.apply(ret, elems);

        } else {
          jQuery.merge(ret, elems);
        }

        // Add the old object onto the stack (as a reference)
        ret.prevObject = this;

        ret.context = this.context;

        if (name === "find") {
          ret.selector = this.selector + (this.selector ? " " : "") + selector;
        } else if (name) {
          ret.selector = this.selector + "." + name + "(" + selector + ")";
        }

        // Return the newly-formed element set
        return ret;
      },

      // Execute a callback for every element in the matched set.
      // (You can seed the arguments with an array of args, but this is
      // only used internally.)
      each: function (callback, args) {
        return jQuery.each(this, callback, args);
      },

      ready: function (fn) {
        // Attach the listeners
        jQuery.bindReady();

        // If the DOM is already ready
        if (jQuery.isReady) {
          // Execute the function immediately
          fn.call(document, jQuery);

          // Otherwise, remember the function for later
        } else if (readyList) {
          // Add the function to the wait list
          readyList.push(fn);
        }

        return this;
      },

      eq: function (i) {
        return i === -1 ?
			this.slice(i) :
			this.slice(i, +i + 1);
      },

      first: function () {
        return this.eq(0);
      },

      last: function () {
        return this.eq(-1);
      },

      slice: function () {
        return this.pushStack(slice.apply(this, arguments),
			"slice", slice.call(arguments).join(","));
      },

      map: function (callback) {
        return this.pushStack(jQuery.map(this, function (elem, i) {
          return callback.call(elem, i, elem);
        }));
      },

      end: function () {
        return this.prevObject || jQuery(null);
      },

      // For internal use only.
      // Behaves like an Array's method, not like a jQuery method.
      push: push,
      sort: [].sort,
      splice: [].splice
    };

    // Give the init function the jQuery prototype for later instantiation
    jQuery.fn.init.prototype = jQuery.fn;

    jQuery.extend = jQuery.fn.extend = function () {
      var options, name, src, copy, copyIsArray, clone,
		target = arguments[0] || {},
		i = 1,
		length = arguments.length,
		deep = false;

      // Handle a deep copy situation
      if (typeof target === "boolean") {
        deep = target;
        target = arguments[1] || {};
        // skip the boolean and the target
        i = 2;
      }

      // Handle case when target is a string or something (possible in deep copy)
      if (typeof target !== "object" && !jQuery.isFunction(target)) {
        target = {};
      }

      // extend jQuery itself if only one argument is passed
      if (length === i) {
        target = this;
        --i;
      }

      for (; i < length; i++) {
        // Only deal with non-null/undefined values
        if ((options = arguments[i]) != null) {
          // Extend the base object
          for (name in options) {
            src = target[name];
            copy = options[name];

            // Prevent never-ending loop
            if (target === copy) {
              continue;
            }

            // Recurse if we're merging plain objects or arrays
            if (deep && copy && (jQuery.isPlainObject(copy) || (copyIsArray = jQuery.isArray(copy)))) {
              if (copyIsArray) {
                copyIsArray = false;
                clone = src && jQuery.isArray(src) ? src : [];

              } else {
                clone = src && jQuery.isPlainObject(src) ? src : {};
              }

              // Never move original objects, clone them
              target[name] = jQuery.extend(deep, clone, copy);

              // Don't bring in undefined values
            } else if (copy !== undefined) {
              target[name] = copy;
            }
          }
        }
      }

      // Return the modified object
      return target;
    };

    jQuery.extend({
      noConflict: function (deep) {
        window.$ = _$;

        if (deep) {
          window.jQuery = _jQuery;
        }

        return jQuery;
      },

      // Is the DOM ready to be used? Set to true once it occurs.
      isReady: false,

      // A counter to track how many items to wait for before
      // the ready event fires. See #6781
      readyWait: 1,

      // Handle when the DOM is ready
      ready: function (wait) {
        // A third-party is pushing the ready event forwards
        if (wait === true) {
          jQuery.readyWait--;
        }

        // Make sure that the DOM is not already loaded
        if (!jQuery.readyWait || (wait !== true && !jQuery.isReady)) {
          // Make sure body exists, at least, in case IE gets a little overzealous (ticket #5443).
          if (!document.body) {
            return setTimeout(jQuery.ready, 1);
          }

          // Remember that the DOM is ready
          jQuery.isReady = true;

          // If a normal DOM Ready event fired, decrement, and wait if need be
          if (wait !== true && --jQuery.readyWait > 0) {
            return;
          }

          // If there are functions bound, to execute
          if (readyList) {
            // Execute all of them
            var fn,
					i = 0,
					ready = readyList;

            // Reset the list of functions
            readyList = null;

            while ((fn = ready[i++])) {
              fn.call(document, jQuery);
            }

            // Trigger any bound ready events
            if (jQuery.fn.trigger) {
              jQuery(document).trigger("ready").unbind("ready");
            }
          }
        }
      },

      bindReady: function () {
        if (readyBound) {
          return;
        }

        readyBound = true;

        // Catch cases where $(document).ready() is called after the
        // browser event has already occurred.
        if (document.readyState === "complete") {
          // Handle it asynchronously to allow scripts the opportunity to delay ready
          return setTimeout(jQuery.ready, 1);
        }

        // Mozilla, Opera and webkit nightlies currently support this event
        if (document.addEventListener) {
          // Use the handy event callback
          document.addEventListener("DOMContentLoaded", DOMContentLoaded, false);

          // A fallback to window.onload, that will always work
          window.addEventListener("load", jQuery.ready, false);

          // If IE event model is used
        } else if (document.attachEvent) {
          // ensure firing before onload,
          // maybe late but safe also for iframes
          document.attachEvent("onreadystatechange", DOMContentLoaded);

          // A fallback to window.onload, that will always work
          window.attachEvent("onload", jQuery.ready);

          // If IE and not a frame
          // continually check to see if the document is ready
          var toplevel = false;

          try {
            toplevel = window.frameElement == null;
          } catch (e) { }

          if (document.documentElement.doScroll && toplevel) {
            doScrollCheck();
          }
        }
      },

      // See test/unit/core.js for details concerning isFunction.
      // Since version 1.3, DOM methods and functions like alert
      // aren't supported. They return false on IE (#2968).
      isFunction: function (obj) {
        return jQuery.type(obj) === "function";
      },

      isArray: Array.isArray || function (obj) {
        return jQuery.type(obj) === "array";
      },

      // A crude way of determining if an object is a window
      isWindow: function (obj) {
        return obj && typeof obj === "object" && "setInterval" in obj;
      },

      isNaN: function (obj) {
        return obj == null || !rdigit.test(obj) || isNaN(obj);
      },

      type: function (obj) {
        return obj == null ?
			String(obj) :
			class2type[toString.call(obj)] || "object";
      },

      isPlainObject: function (obj) {
        // Must be an Object.
        // Because of IE, we also have to check the presence of the constructor property.
        // Make sure that DOM nodes and window objects don't pass through, as well
        if (!obj || jQuery.type(obj) !== "object" || obj.nodeType || jQuery.isWindow(obj)) {
          return false;
        }

        // Not own constructor property must be Object
        if (obj.constructor &&
			!hasOwn.call(obj, "constructor") &&
			!hasOwn.call(obj.constructor.prototype, "isPrototypeOf")) {
          return false;
        }

        // Own properties are enumerated firstly, so to speed up,
        // if last one is own, then all properties are own.

        var key;
        for (key in obj) { }

        return key === undefined || hasOwn.call(obj, key);
      },

      isEmptyObject: function (obj) {
        for (var name in obj) {
          return false;
        }
        return true;
      },

      error: function (msg) {
        throw msg;
      },

      parseJSON: function (data) {
        if (typeof data !== "string" || !data) {
          return null;
        }

        // Make sure leading/trailing whitespace is removed (IE can't handle it)
        data = jQuery.trim(data);

        // Make sure the incoming data is actual JSON
        // Logic borrowed from http://json.org/json2.js
        if (rvalidchars.test(data.replace(rvalidescape, "@")
			.replace(rvalidtokens, "]")
			.replace(rvalidbraces, ""))) {

          // Try to use the native JSON parser first
          return window.JSON && window.JSON.parse ?
				window.JSON.parse(data) :
				(new Function("return " + data))();

        } else {
          jQuery.error("Invalid JSON: " + data);
        }
      },

      noop: function () { },

      // Evalulates a script in a global context
      globalEval: function (data) {
        if (data && rnotwhite.test(data)) {
          // Inspired by code by Andrea Giammarchi
          // http://webreflection.blogspot.com/2007/08/global-scope-evaluation-and-dom.html
          var head = document.getElementsByTagName("head")[0] || document.documentElement,
				script = document.createElement("script");

          script.type = "text/javascript";

          if (jQuery.support.scriptEval) {
            script.appendChild(document.createTextNode(data));
          } else {
            script.text = data;
          }

          // Use insertBefore instead of appendChild to circumvent an IE6 bug.
          // This arises when a base node is used (#2709).
          head.insertBefore(script, head.firstChild);
          head.removeChild(script);
        }
      },

      nodeName: function (elem, name) {
        return elem.nodeName && elem.nodeName.toUpperCase() === name.toUpperCase();
      },

      // args is for internal usage only
      each: function (object, callback, args) {
        var name, i = 0,
			length = object.length,
			isObj = length === undefined || jQuery.isFunction(object);

        if (args) {
          if (isObj) {
            for (name in object) {
              if (callback.apply(object[name], args) === false) {
                break;
              }
            }
          } else {
            for (; i < length; ) {
              if (callback.apply(object[i++], args) === false) {
                break;
              }
            }
          }

          // A special, fast, case for the most common use of each
        } else {
          if (isObj) {
            for (name in object) {
              if (callback.call(object[name], name, object[name]) === false) {
                break;
              }
            }
          } else {
            for (var value = object[0];
					i < length && callback.call(value, i, value) !== false; value = object[++i]) { }
          }
        }

        return object;
      },

      // Use native String.trim function wherever possible
      trim: trim ?
		function (text) {
		  return text == null ?
				"" :
				trim.call(text);
		} :

      // Otherwise use our own trimming functionality
		function (text) {
		  return text == null ?
				"" :
				text.toString().replace(trimLeft, "").replace(trimRight, "");
		},

      // results is for internal usage only
      makeArray: function (array, results) {
        var ret = results || [];

        if (array != null) {
          // The window, strings (and functions) also have 'length'
          // The extra typeof function check is to prevent crashes
          // in Safari 2 (See: #3039)
          // Tweaked logic slightly to handle Blackberry 4.7 RegExp issues #6930
          var type = jQuery.type(array);

          if (array.length == null || type === "string" || type === "function" || type === "regexp" || jQuery.isWindow(array)) {
            push.call(ret, array);
          } else {
            jQuery.merge(ret, array);
          }
        }

        return ret;
      },

      inArray: function (elem, array) {
        if (array.indexOf) {
          return array.indexOf(elem);
        }

        for (var i = 0, length = array.length; i < length; i++) {
          if (array[i] === elem) {
            return i;
          }
        }

        return -1;
      },

      merge: function (first, second) {
        var i = first.length,
			j = 0;

        if (typeof second.length === "number") {
          for (var l = second.length; j < l; j++) {
            first[i++] = second[j];
          }

        } else {
          while (second[j] !== undefined) {
            first[i++] = second[j++];
          }
        }

        first.length = i;

        return first;
      },

      grep: function (elems, callback, inv) {
        var ret = [], retVal;
        inv = !!inv;

        // Go through the array, only saving the items
        // that pass the validator function
        for (var i = 0, length = elems.length; i < length; i++) {
          retVal = !!callback(elems[i], i);
          if (inv !== retVal) {
            ret.push(elems[i]);
          }
        }

        return ret;
      },

      // arg is for internal usage only
      map: function (elems, callback, arg) {
        var ret = [], value;

        // Go through the array, translating each of the items to their
        // new value (or values).
        for (var i = 0, length = elems.length; i < length; i++) {
          value = callback(elems[i], i, arg);

          if (value != null) {
            ret[ret.length] = value;
          }
        }

        return ret.concat.apply([], ret);
      },

      // A global GUID counter for objects
      guid: 1,

      proxy: function (fn, proxy, thisObject) {
        if (arguments.length === 2) {
          if (typeof proxy === "string") {
            thisObject = fn;
            fn = thisObject[proxy];
            proxy = undefined;

          } else if (proxy && !jQuery.isFunction(proxy)) {
            thisObject = proxy;
            proxy = undefined;
          }
        }

        if (!proxy && fn) {
          proxy = function () {
            return fn.apply(thisObject || this, arguments);
          };
        }

        // Set the guid of unique handler to the same of original handler, so it can be removed
        if (fn) {
          proxy.guid = fn.guid = fn.guid || proxy.guid || jQuery.guid++;
        }

        // So proxy can be declared as an argument
        return proxy;
      },

      // Mutifunctional method to get and set values to a collection
      // The value/s can be optionally by executed if its a function
      access: function (elems, key, value, exec, fn, pass) {
        var length = elems.length;

        // Setting many attributes
        if (typeof key === "object") {
          for (var k in key) {
            jQuery.access(elems, k, key[k], exec, fn, value);
          }
          return elems;
        }

        // Setting one attribute
        if (value !== undefined) {
          // Optionally, function values get executed if exec is true
          exec = !pass && exec && jQuery.isFunction(value);

          for (var i = 0; i < length; i++) {
            fn(elems[i], key, exec ? value.call(elems[i], i, fn(elems[i], key)) : value, pass);
          }

          return elems;
        }

        // Getting an attribute
        return length ? fn(elems[0], key) : undefined;
      },

      now: function () {
        return (new Date()).getTime();
      },

      // Use of jQuery.browser is frowned upon.
      // More details: http://docs.jquery.com/Utilities/jQuery.browser
      uaMatch: function (ua) {
        ua = ua.toLowerCase();

        var match = rwebkit.exec(ua) ||
			ropera.exec(ua) ||
			rmsie.exec(ua) ||
			ua.indexOf("compatible") < 0 && rmozilla.exec(ua) ||
			[];

        return { browser: match[1] || "", version: match[2] || "0" };
      },

      browser: {}
    });

    // Populate the class2type map
    jQuery.each("Boolean Number String Function Array Date RegExp Object".split(" "), function (i, name) {
      class2type["[object " + name + "]"] = name.toLowerCase();
    });

    browserMatch = jQuery.uaMatch(userAgent);
    if (browserMatch.browser) {
      jQuery.browser[browserMatch.browser] = true;
      jQuery.browser.version = browserMatch.version;
    }

    // Deprecated, use jQuery.browser.webkit instead
    if (jQuery.browser.webkit) {
      jQuery.browser.safari = true;
    }

    if (indexOf) {
      jQuery.inArray = function (elem, array) {
        return indexOf.call(array, elem);
      };
    }

    // Verify that \s matches non-breaking spaces
    // (IE fails on this test)
    if (!rwhite.test("\xA0")) {
      trimLeft = /^[\s\xA0]+/;
      trimRight = /[\s\xA0]+$/;
    }

    // All jQuery objects should point back to these
    rootjQuery = jQuery(document);

    // Cleanup functions for the document ready method
    if (document.addEventListener) {
      DOMContentLoaded = function () {
        document.removeEventListener("DOMContentLoaded", DOMContentLoaded, false);
        jQuery.ready();
      };

    } else if (document.attachEvent) {
      DOMContentLoaded = function () {
        // Make sure body exists, at least, in case IE gets a little overzealous (ticket #5443).
        if (document.readyState === "complete") {
          document.detachEvent("onreadystatechange", DOMContentLoaded);
          jQuery.ready();
        }
      };
    }

    // The DOM ready check for Internet Explorer
    function doScrollCheck() {
      if (jQuery.isReady) {
        return;
      }

      try {
        // If IE is used, use the trick by Diego Perini
        // http://javascript.nwbox.com/IEContentLoaded/
        document.documentElement.doScroll("left");
      } catch (e) {
        setTimeout(doScrollCheck, 1);
        return;
      }

      // and execute any waiting functions
      jQuery.ready();
    }

    // Expose jQuery to the global object
    return (window.jQuery = window.$ = jQuery);

  })();


  (function () {

    jQuery.support = {};

    var root = document.documentElement,
		script = document.createElement("script"),
		div = document.createElement("div"),
		id = "script" + jQuery.now();

    div.style.display = "none";
    div.innerHTML = "   <link/><table></table><a href='/a' style='color:red;float:left;opacity:.55;'>a</a><input type='checkbox'/>";

    var all = div.getElementsByTagName("*"),
		a = div.getElementsByTagName("a")[0],
		select = document.createElement("select"),
		opt = select.appendChild(document.createElement("option"));

    // Can't get basic test support
    if (!all || !all.length || !a) {
      return;
    }

    jQuery.support = {
      // IE strips leading whitespace when .innerHTML is used
      leadingWhitespace: div.firstChild.nodeType === 3,

      // Make sure that tbody elements aren't automatically inserted
      // IE will insert them into empty tables
      tbody: !div.getElementsByTagName("tbody").length,

      // Make sure that link elements get serialized correctly by innerHTML
      // This requires a wrapper element in IE
      htmlSerialize: !!div.getElementsByTagName("link").length,

      // Get the style information from getAttribute
      // (IE uses .cssText insted)
      style: /red/.test(a.getAttribute("style")),

      // Make sure that URLs aren't manipulated
      // (IE normalizes it by default)
      hrefNormalized: a.getAttribute("href") === "/a",

      // Make sure that element opacity exists
      // (IE uses filter instead)
      // Use a regex to work around a WebKit issue. See #5145
      opacity: /^0.55$/.test(a.style.opacity),

      // Verify style float existence
      // (IE uses styleFloat instead of cssFloat)
      cssFloat: !!a.style.cssFloat,

      // Make sure that if no value is specified for a checkbox
      // that it defaults to "on".
      // (WebKit defaults to "" instead)
      checkOn: div.getElementsByTagName("input")[0].value === "on",

      // Make sure that a selected-by-default option has a working selected property.
      // (WebKit defaults to false instead of true, IE too, if it's in an optgroup)
      optSelected: opt.selected,

      // Will be defined later
      deleteExpando: true,
      optDisabled: false,
      checkClone: false,
      scriptEval: false,
      noCloneEvent: true,
      boxModel: null,
      inlineBlockNeedsLayout: false,
      shrinkWrapBlocks: false,
      reliableHiddenOffsets: true
    };

    // Make sure that the options inside disabled selects aren't marked as disabled
    // (WebKit marks them as diabled)
    select.disabled = true;
    jQuery.support.optDisabled = !opt.disabled;

    script.type = "text/javascript";
    try {
      script.appendChild(document.createTextNode("window." + id + "=1;"));
    } catch (e) { }

    root.insertBefore(script, root.firstChild);

    // Make sure that the execution of code works by injecting a script
    // tag with appendChild/createTextNode
    // (IE doesn't support this, fails, and uses .text instead)
    if (window[id]) {
      jQuery.support.scriptEval = true;
      delete window[id];
    }

    // Test to see if it's possible to delete an expando from an element
    // Fails in Internet Explorer
    try {
      delete script.test;

    } catch (e) {
      jQuery.support.deleteExpando = false;
    }

    root.removeChild(script);

    if (div.attachEvent && div.fireEvent) {
      div.attachEvent("onclick", function click() {
        // Cloning a node shouldn't copy over any
        // bound event handlers (IE does this)
        jQuery.support.noCloneEvent = false;
        div.detachEvent("onclick", click);
      });
      div.cloneNode(true).fireEvent("onclick");
    }

    div = document.createElement("div");
    div.innerHTML = "<input type='radio' name='radiotest' checked='checked'/>";

    var fragment = document.createDocumentFragment();
    fragment.appendChild(div.firstChild);

    // WebKit doesn't clone checked state correctly in fragments
    jQuery.support.checkClone = fragment.cloneNode(true).cloneNode(true).lastChild.checked;

    // Figure out if the W3C box model works as expected
    // document.body must exist before we can do this
    jQuery(function () {
      var div = document.createElement("div");
      div.style.width = div.style.paddingLeft = "1px";

      document.body.appendChild(div);
      jQuery.boxModel = jQuery.support.boxModel = div.offsetWidth === 2;

      if ("zoom" in div.style) {
        // Check if natively block-level elements act like inline-block
        // elements when setting their display to 'inline' and giving
        // them layout
        // (IE < 8 does this)
        div.style.display = "inline";
        div.style.zoom = 1;
        jQuery.support.inlineBlockNeedsLayout = div.offsetWidth === 2;

        // Check if elements with layout shrink-wrap their children
        // (IE 6 does this)
        div.style.display = "";
        div.innerHTML = "<div style='width:4px;'></div>";
        jQuery.support.shrinkWrapBlocks = div.offsetWidth !== 2;
      }

      div.innerHTML = "<table><tr><td style='padding:0;display:none'></td><td>t</td></tr></table>";
      var tds = div.getElementsByTagName("td");

      // Check if table cells still have offsetWidth/Height when they are set
      // to display:none and there are still other visible table cells in a
      // table row; if so, offsetWidth/Height are not reliable for use when
      // determining if an element has been hidden directly using
      // display:none (it is still safe to use offsets if a parent element is
      // hidden; don safety goggles and see bug #4512 for more information).
      // (only IE 8 fails this test)
      jQuery.support.reliableHiddenOffsets = tds[0].offsetHeight === 0;

      tds[0].style.display = "";
      tds[1].style.display = "none";

      // Check if empty table cells still have offsetWidth/Height
      // (IE < 8 fail this test)
      jQuery.support.reliableHiddenOffsets = jQuery.support.reliableHiddenOffsets && tds[0].offsetHeight === 0;
      div.innerHTML = "";

      document.body.removeChild(div).style.display = "none";
      div = tds = null;
    });

    // Technique from Juriy Zaytsev
    // http://thinkweb2.com/projects/prototype/detecting-event-support-without-browser-sniffing/
    var eventSupported = function (eventName) {
      var el = document.createElement("div");
      eventName = "on" + eventName;

      var isSupported = (eventName in el);
      if (!isSupported) {
        el.setAttribute(eventName, "return;");
        isSupported = typeof el[eventName] === "function";
      }
      el = null;

      return isSupported;
    };

    jQuery.support.submitBubbles = eventSupported("submit");
    jQuery.support.changeBubbles = eventSupported("change");

    // release memory in IE
    root = script = div = all = a = null;
  })();



  var windowData = {},
	rbrace = /^(?:\{.*\}|\[.*\])$/;

  jQuery.extend({
    cache: {},

    // Please use with caution
    uuid: 0,

    // Unique for each copy of jQuery on the page	
    expando: "jQuery" + jQuery.now(),

    // The following elements throw uncatchable exceptions if you
    // attempt to add expando properties to them.
    noData: {
      "embed": true,
      // Ban all objects except for Flash (which handle expandos)
      "object": "clsid:D27CDB6E-AE6D-11cf-96B8-444553540000",
      "applet": true
    },

    data: function (elem, name, data) {
      if (!jQuery.acceptData(elem)) {
        return;
      }

      elem = elem == window ?
			windowData :
			elem;

      var isNode = elem.nodeType,
			id = isNode ? elem[jQuery.expando] : null,
			cache = jQuery.cache, thisCache;

      if (isNode && !id && typeof name === "string" && data === undefined) {
        return;
      }

      // Get the data from the object directly
      if (!isNode) {
        cache = elem;

        // Compute a unique ID for the element
      } else if (!id) {
        elem[jQuery.expando] = id = ++jQuery.uuid;
      }

      // Avoid generating a new cache unless none exists and we
      // want to manipulate it.
      if (typeof name === "object") {
        if (isNode) {
          cache[id] = jQuery.extend(cache[id], name);

        } else {
          jQuery.extend(cache, name);
        }

      } else if (isNode && !cache[id]) {
        cache[id] = {};
      }

      thisCache = isNode ? cache[id] : cache;

      // Prevent overriding the named cache with undefined values
      if (data !== undefined) {
        thisCache[name] = data;
      }

      return typeof name === "string" ? thisCache[name] : thisCache;
    },

    removeData: function (elem, name) {
      if (!jQuery.acceptData(elem)) {
        return;
      }

      elem = elem == window ?
			windowData :
			elem;

      var isNode = elem.nodeType,
			id = isNode ? elem[jQuery.expando] : elem,
			cache = jQuery.cache,
			thisCache = isNode ? cache[id] : id;

      // If we want to remove a specific section of the element's data
      if (name) {
        if (thisCache) {
          // Remove the section of cache data
          delete thisCache[name];

          // If we've removed all the data, remove the element's cache
          if (isNode && jQuery.isEmptyObject(thisCache)) {
            jQuery.removeData(elem);
          }
        }

        // Otherwise, we want to remove all of the element's data
      } else {
        if (isNode && jQuery.support.deleteExpando) {
          delete elem[jQuery.expando];

        } else if (elem.removeAttribute) {
          elem.removeAttribute(jQuery.expando);

          // Completely remove the data cache
        } else if (isNode) {
          delete cache[id];

          // Remove all fields from the object
        } else {
          for (var n in elem) {
            delete elem[n];
          }
        }
      }
    },

    // A method for determining if a DOM node can handle the data expando
    acceptData: function (elem) {
      if (elem.nodeName) {
        var match = jQuery.noData[elem.nodeName.toLowerCase()];

        if (match) {
          return !(match === true || elem.getAttribute("classid") !== match);
        }
      }

      return true;
    }
  });

  jQuery.fn.extend({
    data: function (key, value) {
      var data = null;

      if (typeof key === "undefined") {
        if (this.length) {
          var attr = this[0].attributes, name;
          data = jQuery.data(this[0]);

          for (var i = 0, l = attr.length; i < l; i++) {
            name = attr[i].name;

            if (name.indexOf("data-") === 0) {
              name = name.substr(5);
              dataAttr(this[0], name, data[name]);
            }
          }
        }

        return data;

      } else if (typeof key === "object") {
        return this.each(function () {
          jQuery.data(this, key);
        });
      }

      var parts = key.split(".");
      parts[1] = parts[1] ? "." + parts[1] : "";

      if (value === undefined) {
        data = this.triggerHandler("getData" + parts[1] + "!", [parts[0]]);

        // Try to fetch any internally stored data first
        if (data === undefined && this.length) {
          data = jQuery.data(this[0], key);
          data = dataAttr(this[0], key, data);
        }

        return data === undefined && parts[1] ?
				this.data(parts[0]) :
				data;

      } else {
        return this.each(function () {
          var $this = jQuery(this),
					args = [parts[0], value];

          $this.triggerHandler("setData" + parts[1] + "!", args);
          jQuery.data(this, key, value);
          $this.triggerHandler("changeData" + parts[1] + "!", args);
        });
      }
    },

    removeData: function (key) {
      return this.each(function () {
        jQuery.removeData(this, key);
      });
    }
  });

  function dataAttr(elem, key, data) {
    // If nothing was found internally, try to fetch any
    // data from the HTML5 data-* attribute
    if (data === undefined && elem.nodeType === 1) {
      data = elem.getAttribute("data-" + key);

      if (typeof data === "string") {
        try {
          data = data === "true" ? true :
				data === "false" ? false :
				data === "null" ? null :
				!jQuery.isNaN(data) ? parseFloat(data) :
					rbrace.test(data) ? jQuery.parseJSON(data) :
					data;
        } catch (e) { }

        // Make sure we set the data so it isn't changed later
        jQuery.data(elem, key, data);

      } else {
        data = undefined;
      }
    }

    return data;
  }




  jQuery.extend({
    queue: function (elem, type, data) {
      if (!elem) {
        return;
      }

      type = (type || "fx") + "queue";
      var q = jQuery.data(elem, type);

      // Speed up dequeue by getting out quickly if this is just a lookup
      if (!data) {
        return q || [];
      }

      if (!q || jQuery.isArray(data)) {
        q = jQuery.data(elem, type, jQuery.makeArray(data));

      } else {
        q.push(data);
      }

      return q;
    },

    dequeue: function (elem, type) {
      type = type || "fx";

      var queue = jQuery.queue(elem, type),
			fn = queue.shift();

      // If the fx queue is dequeued, always remove the progress sentinel
      if (fn === "inprogress") {
        fn = queue.shift();
      }

      if (fn) {
        // Add a progress sentinel to prevent the fx queue from being
        // automatically dequeued
        if (type === "fx") {
          queue.unshift("inprogress");
        }

        fn.call(elem, function () {
          jQuery.dequeue(elem, type);
        });
      }
    }
  });

  jQuery.fn.extend({
    queue: function (type, data) {
      if (typeof type !== "string") {
        data = type;
        type = "fx";
      }

      if (data === undefined) {
        return jQuery.queue(this[0], type);
      }
      return this.each(function (i) {
        var queue = jQuery.queue(this, type, data);

        if (type === "fx" && queue[0] !== "inprogress") {
          jQuery.dequeue(this, type);
        }
      });
    },
    dequeue: function (type) {
      return this.each(function () {
        jQuery.dequeue(this, type);
      });
    },

    // Based off of the plugin by Clint Helfers, with permission.
    // http://blindsignals.com/index.php/2009/07/jquery-delay/
    delay: function (time, type) {
      time = jQuery.fx ? jQuery.fx.speeds[time] || time : time;
      type = type || "fx";

      return this.queue(type, function () {
        var elem = this;
        setTimeout(function () {
          jQuery.dequeue(elem, type);
        }, time);
      });
    },

    clearQueue: function (type) {
      return this.queue(type || "fx", []);
    }
  });




  var rclass = /[\n\t]/g,
	rspaces = /\s+/,
	rreturn = /\r/g,
	rspecialurl = /^(?:href|src|style)$/,
	rtype = /^(?:button|input)$/i,
	rfocusable = /^(?:button|input|object|select|textarea)$/i,
	rclickable = /^a(?:rea)?$/i,
	rradiocheck = /^(?:radio|checkbox)$/i;

  jQuery.props = {
    "for": "htmlFor",
    "class": "className",
    readonly: "readOnly",
    maxlength: "maxLength",
    cellspacing: "cellSpacing",
    rowspan: "rowSpan",
    colspan: "colSpan",
    tabindex: "tabIndex",
    usemap: "useMap",
    frameborder: "frameBorder"
  };

  jQuery.fn.extend({
    attr: function (name, value) {
      return jQuery.access(this, name, value, true, jQuery.attr);
    },

    removeAttr: function (name, fn) {
      return this.each(function () {
        jQuery.attr(this, name, "");
        if (this.nodeType === 1) {
          this.removeAttribute(name);
        }
      });
    },

    addClass: function (value) {
      if (jQuery.isFunction(value)) {
        return this.each(function (i) {
          var self = jQuery(this);
          self.addClass(value.call(this, i, self.attr("class")));
        });
      }

      if (value && typeof value === "string") {
        var classNames = (value || "").split(rspaces);

        for (var i = 0, l = this.length; i < l; i++) {
          var elem = this[i];

          if (elem.nodeType === 1) {
            if (!elem.className) {
              elem.className = value;

            } else {
              var className = " " + elem.className + " ",
							setClass = elem.className;

              for (var c = 0, cl = classNames.length; c < cl; c++) {
                if (className.indexOf(" " + classNames[c] + " ") < 0) {
                  setClass += " " + classNames[c];
                }
              }
              elem.className = jQuery.trim(setClass);
            }
          }
        }
      }

      return this;
    },

    removeClass: function (value) {
      if (jQuery.isFunction(value)) {
        return this.each(function (i) {
          var self = jQuery(this);
          self.removeClass(value.call(this, i, self.attr("class")));
        });
      }

      if ((value && typeof value === "string") || value === undefined) {
        var classNames = (value || "").split(rspaces);

        for (var i = 0, l = this.length; i < l; i++) {
          var elem = this[i];

          if (elem.nodeType === 1 && elem.className) {
            if (value) {
              var className = (" " + elem.className + " ").replace(rclass, " ");
              for (var c = 0, cl = classNames.length; c < cl; c++) {
                className = className.replace(" " + classNames[c] + " ", " ");
              }
              elem.className = jQuery.trim(className);

            } else {
              elem.className = "";
            }
          }
        }
      }

      return this;
    },

    toggleClass: function (value, stateVal) {
      var type = typeof value,
			isBool = typeof stateVal === "boolean";

      if (jQuery.isFunction(value)) {
        return this.each(function (i) {
          var self = jQuery(this);
          self.toggleClass(value.call(this, i, self.attr("class"), stateVal), stateVal);
        });
      }

      return this.each(function () {
        if (type === "string") {
          // toggle individual class names
          var className,
					i = 0,
					self = jQuery(this),
					state = stateVal,
					classNames = value.split(rspaces);

          while ((className = classNames[i++])) {
            // check each className given, space seperated list
            state = isBool ? state : !self.hasClass(className);
            self[state ? "addClass" : "removeClass"](className);
          }

        } else if (type === "undefined" || type === "boolean") {
          if (this.className) {
            // store className if set
            jQuery.data(this, "__className__", this.className);
          }

          // toggle whole className
          this.className = this.className || value === false ? "" : jQuery.data(this, "__className__") || "";
        }
      });
    },

    hasClass: function (selector) {
      var className = " " + selector + " ";
      for (var i = 0, l = this.length; i < l; i++) {
        if ((" " + this[i].className + " ").replace(rclass, " ").indexOf(className) > -1) {
          return true;
        }
      }

      return false;
    },

    val: function (value) {
      if (!arguments.length) {
        var elem = this[0];

        if (elem) {
          if (jQuery.nodeName(elem, "option")) {
            // attributes.value is undefined in Blackberry 4.7 but
            // uses .value. See #6932
            var val = elem.attributes.value;
            return !val || val.specified ? elem.value : elem.text;
          }

          // We need to handle select boxes special
          if (jQuery.nodeName(elem, "select")) {
            var index = elem.selectedIndex,
						values = [],
						options = elem.options,
						one = elem.type === "select-one";

            // Nothing was selected
            if (index < 0) {
              return null;
            }

            // Loop through all the selected options
            for (var i = one ? index : 0, max = one ? index + 1 : options.length; i < max; i++) {
              var option = options[i];

              // Don't return options that are disabled or in a disabled optgroup
              if (option.selected && (jQuery.support.optDisabled ? !option.disabled : option.getAttribute("disabled") === null) &&
								(!option.parentNode.disabled || !jQuery.nodeName(option.parentNode, "optgroup"))) {

                // Get the specific value for the option
                value = jQuery(option).val();

                // We don't need an array for one selects
                if (one) {
                  return value;
                }

                // Multi-Selects return an array
                values.push(value);
              }
            }

            return values;
          }

          // Handle the case where in Webkit "" is returned instead of "on" if a value isn't specified
          if (rradiocheck.test(elem.type) && !jQuery.support.checkOn) {
            return elem.getAttribute("value") === null ? "on" : elem.value;
          }


          // Everything else, we just grab the value
          return (elem.value || "").replace(rreturn, "");

        }

        return undefined;
      }

      var isFunction = jQuery.isFunction(value);

      return this.each(function (i) {
        var self = jQuery(this), val = value;

        if (this.nodeType !== 1) {
          return;
        }

        if (isFunction) {
          val = value.call(this, i, self.val());
        }

        // Treat null/undefined as ""; convert numbers to string
        if (val == null) {
          val = "";
        } else if (typeof val === "number") {
          val += "";
        } else if (jQuery.isArray(val)) {
          val = jQuery.map(val, function (value) {
            return value == null ? "" : value + "";
          });
        }

        if (jQuery.isArray(val) && rradiocheck.test(this.type)) {
          this.checked = jQuery.inArray(self.val(), val) >= 0;

        } else if (jQuery.nodeName(this, "select")) {
          var values = jQuery.makeArray(val);

          jQuery("option", this).each(function () {
            this.selected = jQuery.inArray(jQuery(this).val(), values) >= 0;
          });

          if (!values.length) {
            this.selectedIndex = -1;
          }

        } else {
          this.value = val;
        }
      });
    }
  });

  jQuery.extend({
    attrFn: {
      val: true,
      css: true,
      html: true,
      text: true,
      data: true,
      width: true,
      height: true,
      offset: true
    },

    attr: function (elem, name, value, pass) {
      // don't set attributes on text and comment nodes
      if (!elem || elem.nodeType === 3 || elem.nodeType === 8) {
        return undefined;
      }

      if (pass && name in jQuery.attrFn) {
        return jQuery(elem)[name](value);
      }

      var notxml = elem.nodeType !== 1 || !jQuery.isXMLDoc(elem),
      // Whether we are setting (or getting)
			set = value !== undefined;

      // Try to normalize/fix the name
      name = notxml && jQuery.props[name] || name;

      // These attributes require special treatment
      var special = rspecialurl.test(name);

      // Safari mis-reports the default selected property of an option
      // Accessing the parent's selectedIndex property fixes it
      if (name === "selected" && !jQuery.support.optSelected) {
        var parent = elem.parentNode;
        if (parent) {
          parent.selectedIndex;

          // Make sure that it also works with optgroups, see #5701
          if (parent.parentNode) {
            parent.parentNode.selectedIndex;
          }
        }
      }

      // If applicable, access the attribute via the DOM 0 way
      // 'in' checks fail in Blackberry 4.7 #6931
      if ((name in elem || elem[name] !== undefined) && notxml && !special) {
        if (set) {
          // We can't allow the type property to be changed (since it causes problems in IE)
          if (name === "type" && rtype.test(elem.nodeName) && elem.parentNode) {
            jQuery.error("type property can't be changed");
          }

          if (value === null) {
            if (elem.nodeType === 1) {
              elem.removeAttribute(name);
            }

          } else {
            elem[name] = value;
          }
        }

        // browsers index elements by id/name on forms, give priority to attributes.
        if (jQuery.nodeName(elem, "form") && elem.getAttributeNode(name)) {
          return elem.getAttributeNode(name).nodeValue;
        }

        // elem.tabIndex doesn't always return the correct value when it hasn't been explicitly set
        // http://fluidproject.org/blog/2008/01/09/getting-setting-and-removing-tabindex-values-with-javascript/
        if (name === "tabIndex") {
          var attributeNode = elem.getAttributeNode("tabIndex");

          return attributeNode && attributeNode.specified ?
					attributeNode.value :
					rfocusable.test(elem.nodeName) || rclickable.test(elem.nodeName) && elem.href ?
						0 :
						undefined;
        }

        return elem[name];
      }

      if (!jQuery.support.style && notxml && name === "style") {
        if (set) {
          elem.style.cssText = "" + value;
        }

        return elem.style.cssText;
      }

      if (set) {
        // convert the value to a string (all browsers do this but IE) see #1070
        elem.setAttribute(name, "" + value);
      }

      // Ensure that missing attributes return undefined
      // Blackberry 4.7 returns "" from getAttribute #6938
      if (!elem.attributes[name] && (elem.hasAttribute && !elem.hasAttribute(name))) {
        return undefined;
      }

      var attr = !jQuery.support.hrefNormalized && notxml && special ?
      // Some attributes require a special call on IE
				elem.getAttribute(name, 2) :
				elem.getAttribute(name);

      // Non-existent attributes return null, we normalize to undefined
      return attr === null ? undefined : attr;
    }
  });




  var rnamespaces = /\.(.*)$/,
	rformElems = /^(?:textarea|input|select)$/i,
	rperiod = /\./g,
	rspace = / /g,
	rescape = /[^\w\s.|`]/g,
	fcleanup = function (nm) {
	  return nm.replace(rescape, "\\$&");
	},
	focusCounts = { focusin: 0, focusout: 0 };

  /*
  * A number of helper functions used for managing events.
  * Many of the ideas behind this code originated from
  * Dean Edwards' addEvent library.
  */
  jQuery.event = {

    // Bind an event to an element
    // Original by Dean Edwards
    add: function (elem, types, handler, data) {
      if (elem.nodeType === 3 || elem.nodeType === 8) {
        return;
      }

      // For whatever reason, IE has trouble passing the window object
      // around, causing it to be cloned in the process
      if (jQuery.isWindow(elem) && (elem !== window && !elem.frameElement)) {
        elem = window;
      }

      if (handler === false) {
        handler = returnFalse;
      } else if (!handler) {
        // Fixes bug #7229. Fix recommended by jdalton
        return;
      }

      var handleObjIn, handleObj;

      if (handler.handler) {
        handleObjIn = handler;
        handler = handleObjIn.handler;
      }

      // Make sure that the function being executed has a unique ID
      if (!handler.guid) {
        handler.guid = jQuery.guid++;
      }

      // Init the element's event structure
      var elemData = jQuery.data(elem);

      // If no elemData is found then we must be trying to bind to one of the
      // banned noData elements
      if (!elemData) {
        return;
      }

      // Use a key less likely to result in collisions for plain JS objects.
      // Fixes bug #7150.
      var eventKey = elem.nodeType ? "events" : "__events__",
			events = elemData[eventKey],
			eventHandle = elemData.handle;

      if (typeof events === "function") {
        // On plain objects events is a fn that holds the the data
        // which prevents this data from being JSON serialized
        // the function does not need to be called, it just contains the data
        eventHandle = events.handle;
        events = events.events;

      } else if (!events) {
        if (!elem.nodeType) {
          // On plain objects, create a fn that acts as the holder
          // of the values to avoid JSON serialization of event data
          elemData[eventKey] = elemData = function () { };
        }

        elemData.events = events = {};
      }

      if (!eventHandle) {
        elemData.handle = eventHandle = function () {
          // Handle the second event of a trigger and when
          // an event is called after a page has unloaded
          return typeof jQuery !== "undefined" && !jQuery.event.triggered ?
					jQuery.event.handle.apply(eventHandle.elem, arguments) :
					undefined;
        };
      }

      // Add elem as a property of the handle function
      // This is to prevent a memory leak with non-native events in IE.
      eventHandle.elem = elem;

      // Handle multiple events separated by a space
      // jQuery(...).bind("mouseover mouseout", fn);
      types = types.split(" ");

      var type, i = 0, namespaces;

      while ((type = types[i++])) {
        handleObj = handleObjIn ?
				jQuery.extend({}, handleObjIn) :
				{ handler: handler, data: data };

        // Namespaced event handlers
        if (type.indexOf(".") > -1) {
          namespaces = type.split(".");
          type = namespaces.shift();
          handleObj.namespace = namespaces.slice(0).sort().join(".");

        } else {
          namespaces = [];
          handleObj.namespace = "";
        }

        handleObj.type = type;
        if (!handleObj.guid) {
          handleObj.guid = handler.guid;
        }

        // Get the current list of functions bound to this event
        var handlers = events[type],
				special = jQuery.event.special[type] || {};

        // Init the event handler queue
        if (!handlers) {
          handlers = events[type] = [];

          // Check for a special event handler
          // Only use addEventListener/attachEvent if the special
          // events handler returns false
          if (!special.setup || special.setup.call(elem, data, namespaces, eventHandle) === false) {
            // Bind the global event handler to the element
            if (elem.addEventListener) {
              elem.addEventListener(type, eventHandle, false);

            } else if (elem.attachEvent) {
              elem.attachEvent("on" + type, eventHandle);
            }
          }
        }

        if (special.add) {
          special.add.call(elem, handleObj);

          if (!handleObj.handler.guid) {
            handleObj.handler.guid = handler.guid;
          }
        }

        // Add the function to the element's handler list
        handlers.push(handleObj);

        // Keep track of which events have been used, for global triggering
        jQuery.event.global[type] = true;
      }

      // Nullify elem to prevent memory leaks in IE
      elem = null;
    },

    global: {},

    // Detach an event or set of events from an element
    remove: function (elem, types, handler, pos) {
      // don't do events on text and comment nodes
      if (elem.nodeType === 3 || elem.nodeType === 8) {
        return;
      }

      if (handler === false) {
        handler = returnFalse;
      }

      var ret, type, fn, j, i = 0, all, namespaces, namespace, special, eventType, handleObj, origType,
			eventKey = elem.nodeType ? "events" : "__events__",
			elemData = jQuery.data(elem),
			events = elemData && elemData[eventKey];

      if (!elemData || !events) {
        return;
      }

      if (typeof events === "function") {
        elemData = events;
        events = events.events;
      }

      // types is actually an event object here
      if (types && types.type) {
        handler = types.handler;
        types = types.type;
      }

      // Unbind all events for the element
      if (!types || typeof types === "string" && types.charAt(0) === ".") {
        types = types || "";

        for (type in events) {
          jQuery.event.remove(elem, type + types);
        }

        return;
      }

      // Handle multiple events separated by a space
      // jQuery(...).unbind("mouseover mouseout", fn);
      types = types.split(" ");

      while ((type = types[i++])) {
        origType = type;
        handleObj = null;
        all = type.indexOf(".") < 0;
        namespaces = [];

        if (!all) {
          // Namespaced event handlers
          namespaces = type.split(".");
          type = namespaces.shift();

          namespace = new RegExp("(^|\\.)" +
					jQuery.map(namespaces.slice(0).sort(), fcleanup).join("\\.(?:.*\\.)?") + "(\\.|$)");
        }

        eventType = events[type];

        if (!eventType) {
          continue;
        }

        if (!handler) {
          for (j = 0; j < eventType.length; j++) {
            handleObj = eventType[j];

            if (all || namespace.test(handleObj.namespace)) {
              jQuery.event.remove(elem, origType, handleObj.handler, j);
              eventType.splice(j--, 1);
            }
          }

          continue;
        }

        special = jQuery.event.special[type] || {};

        for (j = pos || 0; j < eventType.length; j++) {
          handleObj = eventType[j];

          if (handler.guid === handleObj.guid) {
            // remove the given handler for the given type
            if (all || namespace.test(handleObj.namespace)) {
              if (pos == null) {
                eventType.splice(j--, 1);
              }

              if (special.remove) {
                special.remove.call(elem, handleObj);
              }
            }

            if (pos != null) {
              break;
            }
          }
        }

        // remove generic event handler if no more handlers exist
        if (eventType.length === 0 || pos != null && eventType.length === 1) {
          if (!special.teardown || special.teardown.call(elem, namespaces) === false) {
            jQuery.removeEvent(elem, type, elemData.handle);
          }

          ret = null;
          delete events[type];
        }
      }

      // Remove the expando if it's no longer used
      if (jQuery.isEmptyObject(events)) {
        var handle = elemData.handle;
        if (handle) {
          handle.elem = null;
        }

        delete elemData.events;
        delete elemData.handle;

        if (typeof elemData === "function") {
          jQuery.removeData(elem, eventKey);

        } else if (jQuery.isEmptyObject(elemData)) {
          jQuery.removeData(elem);
        }
      }
    },

    // bubbling is internal
    trigger: function (event, data, elem /*, bubbling */) {
      // Event object or event type
      var type = event.type || event,
			bubbling = arguments[3];

      if (!bubbling) {
        event = typeof event === "object" ?
        // jQuery.Event object
				event[jQuery.expando] ? event :
        // Object literal
				jQuery.extend(jQuery.Event(type), event) :
        // Just the event type (string)
				jQuery.Event(type);

        if (type.indexOf("!") >= 0) {
          event.type = type = type.slice(0, -1);
          event.exclusive = true;
        }

        // Handle a global trigger
        if (!elem) {
          // Don't bubble custom events when global (to avoid too much overhead)
          event.stopPropagation();

          // Only trigger if we've ever bound an event for it
          if (jQuery.event.global[type]) {
            jQuery.each(jQuery.cache, function () {
              if (this.events && this.events[type]) {
                jQuery.event.trigger(event, data, this.handle.elem);
              }
            });
          }
        }

        // Handle triggering a single element

        // don't do events on text and comment nodes
        if (!elem || elem.nodeType === 3 || elem.nodeType === 8) {
          return undefined;
        }

        // Clean up in case it is reused
        event.result = undefined;
        event.target = elem;

        // Clone the incoming data, if any
        data = jQuery.makeArray(data);
        data.unshift(event);
      }

      event.currentTarget = elem;

      // Trigger the event, it is assumed that "handle" is a function
      var handle = elem.nodeType ?
			jQuery.data(elem, "handle") :
			(jQuery.data(elem, "__events__") || {}).handle;

      if (handle) {
        handle.apply(elem, data);
      }

      var parent = elem.parentNode || elem.ownerDocument;

      // Trigger an inline bound script
      try {
        if (!(elem && elem.nodeName && jQuery.noData[elem.nodeName.toLowerCase()])) {
          if (elem["on" + type] && elem["on" + type].apply(elem, data) === false) {
            event.result = false;
            event.preventDefault();
          }
        }

        // prevent IE from throwing an error for some elements with some event types, see #3533
      } catch (inlineError) { }

      if (!event.isPropagationStopped() && parent) {
        jQuery.event.trigger(event, data, parent, true);

      } else if (!event.isDefaultPrevented()) {
        var old,
				target = event.target,
				targetType = type.replace(rnamespaces, ""),
				isClick = jQuery.nodeName(target, "a") && targetType === "click",
				special = jQuery.event.special[targetType] || {};

        if ((!special._default || special._default.call(elem, event) === false) &&
				!isClick && !(target && target.nodeName && jQuery.noData[target.nodeName.toLowerCase()])) {

          try {
            if (target[targetType]) {
              // Make sure that we don't accidentally re-trigger the onFOO events
              old = target["on" + targetType];

              if (old) {
                target["on" + targetType] = null;
              }

              jQuery.event.triggered = true;
              target[targetType]();
            }

            // prevent IE from throwing an error for some elements with some event types, see #3533
          } catch (triggerError) { }

          if (old) {
            target["on" + targetType] = old;
          }

          jQuery.event.triggered = false;
        }
      }
    },

    handle: function (event) {
      var all, handlers, namespaces, namespace_re, events,
			namespace_sort = [],
			args = jQuery.makeArray(arguments);

      event = args[0] = jQuery.event.fix(event || window.event);
      event.currentTarget = this;

      // Namespaced event handlers
      all = event.type.indexOf(".") < 0 && !event.exclusive;

      if (!all) {
        namespaces = event.type.split(".");
        event.type = namespaces.shift();
        namespace_sort = namespaces.slice(0).sort();
        namespace_re = new RegExp("(^|\\.)" + namespace_sort.join("\\.(?:.*\\.)?") + "(\\.|$)");
      }

      event.namespace = event.namespace || namespace_sort.join(".");

      events = jQuery.data(this, this.nodeType ? "events" : "__events__");

      if (typeof events === "function") {
        events = events.events;
      }

      handlers = (events || {})[event.type];

      if (events && handlers) {
        // Clone the handlers to prevent manipulation
        handlers = handlers.slice(0);

        for (var j = 0, l = handlers.length; j < l; j++) {
          var handleObj = handlers[j];

          // Filter the functions by class
          if (all || namespace_re.test(handleObj.namespace)) {
            // Pass in a reference to the handler function itself
            // So that we can later remove it
            event.handler = handleObj.handler;
            event.data = handleObj.data;
            event.handleObj = handleObj;

            var ret = handleObj.handler.apply(this, args);

            if (ret !== undefined) {
              event.result = ret;
              if (ret === false) {
                event.preventDefault();
                event.stopPropagation();
              }
            }

            if (event.isImmediatePropagationStopped()) {
              break;
            }
          }
        }
      }

      return event.result;
    },

    props: "altKey attrChange attrName bubbles button cancelable charCode clientX clientY ctrlKey currentTarget data detail eventPhase fromElement handler keyCode layerX layerY metaKey newValue offsetX offsetY pageX pageY prevValue relatedNode relatedTarget screenX screenY shiftKey srcElement target toElement view wheelDelta which".split(" "),

    fix: function (event) {
      if (event[jQuery.expando]) {
        return event;
      }

      // store a copy of the original event object
      // and "clone" to set read-only properties
      var originalEvent = event;
      event = jQuery.Event(originalEvent);

      for (var i = this.props.length, prop; i; ) {
        prop = this.props[--i];
        event[prop] = originalEvent[prop];
      }

      // Fix target property, if necessary
      if (!event.target) {
        // Fixes #1925 where srcElement might not be defined either
        event.target = event.srcElement || document;
      }

      // check if target is a textnode (safari)
      if (event.target.nodeType === 3) {
        event.target = event.target.parentNode;
      }

      // Add relatedTarget, if necessary
      if (!event.relatedTarget && event.fromElement) {
        event.relatedTarget = event.fromElement === event.target ? event.toElement : event.fromElement;
      }

      // Calculate pageX/Y if missing and clientX/Y available
      if (event.pageX == null && event.clientX != null) {
        var doc = document.documentElement,
				body = document.body;

        event.pageX = event.clientX + (doc && doc.scrollLeft || body && body.scrollLeft || 0) - (doc && doc.clientLeft || body && body.clientLeft || 0);
        event.pageY = event.clientY + (doc && doc.scrollTop || body && body.scrollTop || 0) - (doc && doc.clientTop || body && body.clientTop || 0);
      }

      // Add which for key events
      if (event.which == null && (event.charCode != null || event.keyCode != null)) {
        event.which = event.charCode != null ? event.charCode : event.keyCode;
      }

      // Add metaKey to non-Mac browsers (use ctrl for PC's and Meta for Macs)
      if (!event.metaKey && event.ctrlKey) {
        event.metaKey = event.ctrlKey;
      }

      // Add which for click: 1 === left; 2 === middle; 3 === right
      // Note: button is not normalized, so don't use it
      if (!event.which && event.button !== undefined) {
        event.which = (event.button & 1 ? 1 : (event.button & 2 ? 3 : (event.button & 4 ? 2 : 0)));
      }

      return event;
    },

    // Deprecated, use jQuery.guid instead
    guid: 1E8,

    // Deprecated, use jQuery.proxy instead
    proxy: jQuery.proxy,

    special: {
      ready: {
        // Make sure the ready event is setup
        setup: jQuery.bindReady,
        teardown: jQuery.noop
      },

      live: {
        add: function (handleObj) {
          jQuery.event.add(this,
					liveConvert(handleObj.origType, handleObj.selector),
					jQuery.extend({}, handleObj, { handler: liveHandler, guid: handleObj.handler.guid }));
        },

        remove: function (handleObj) {
          jQuery.event.remove(this, liveConvert(handleObj.origType, handleObj.selector), handleObj);
        }
      },

      beforeunload: {
        setup: function (data, namespaces, eventHandle) {
          // We only want to do this special case on windows
          if (jQuery.isWindow(this)) {
            this.onbeforeunload = eventHandle;
          }
        },

        teardown: function (namespaces, eventHandle) {
          if (this.onbeforeunload === eventHandle) {
            this.onbeforeunload = null;
          }
        }
      }
    }
  };

  jQuery.removeEvent = document.removeEventListener ?
	function (elem, type, handle) {
	  if (elem.removeEventListener) {
	    elem.removeEventListener(type, handle, false);
	  }
	} :
	function (elem, type, handle) {
	  if (elem.detachEvent) {
	    elem.detachEvent("on" + type, handle);
	  }
	};

  jQuery.Event = function (src) {
    // Allow instantiation without the 'new' keyword
    if (!this.preventDefault) {
      return new jQuery.Event(src);
    }

    // Event object
    if (src && src.type) {
      this.originalEvent = src;
      this.type = src.type;
      // Event type
    } else {
      this.type = src;
    }

    // timeStamp is buggy for some events on Firefox(#3843)
    // So we won't rely on the native value
    this.timeStamp = jQuery.now();

    // Mark it as fixed
    this[jQuery.expando] = true;
  };

  function returnFalse() {
    return false;
  }
  function returnTrue() {
    return true;
  }

  // jQuery.Event is based on DOM3 Events as specified by the ECMAScript Language Binding
  // http://www.w3.org/TR/2003/WD-DOM-Level-3-Events-20030331/ecma-script-binding.html
  jQuery.Event.prototype = {
    preventDefault: function () {
      this.isDefaultPrevented = returnTrue;

      var e = this.originalEvent;
      if (!e) {
        return;
      }

      // if preventDefault exists run it on the original event
      if (e.preventDefault) {
        e.preventDefault();

        // otherwise set the returnValue property of the original event to false (IE)
      } else {
        e.returnValue = false;
      }
    },
    stopPropagation: function () {
      this.isPropagationStopped = returnTrue;

      var e = this.originalEvent;
      if (!e) {
        return;
      }
      // if stopPropagation exists run it on the original event
      if (e.stopPropagation) {
        e.stopPropagation();
      }
      // otherwise set the cancelBubble property of the original event to true (IE)
      e.cancelBubble = true;
    },
    stopImmediatePropagation: function () {
      this.isImmediatePropagationStopped = returnTrue;
      this.stopPropagation();
    },
    isDefaultPrevented: returnFalse,
    isPropagationStopped: returnFalse,
    isImmediatePropagationStopped: returnFalse
  };

  // Checks if an event happened on an element within another element
  // Used in jQuery.event.special.mouseenter and mouseleave handlers
  var withinElement = function (event) {
    // Check if mouse(over|out) are still within the same parent element
    var parent = event.relatedTarget;

    // Firefox sometimes assigns relatedTarget a XUL element
    // which we cannot access the parentNode property of
    try {
      // Traverse up the tree
      while (parent && parent !== this) {
        parent = parent.parentNode;
      }

      if (parent !== this) {
        // set the correct event type
        event.type = event.data;

        // handle event if we actually just moused on to a non sub-element
        jQuery.event.handle.apply(this, arguments);
      }

      // assuming we've left the element since we most likely mousedover a xul element
    } catch (e) { }
  },

  // In case of event delegation, we only need to rename the event.type,
  // liveHandler will take care of the rest.
delegate = function (event) {
  event.type = event.data;
  jQuery.event.handle.apply(this, arguments);
};

  // Create mouseenter and mouseleave events
  jQuery.each({
    mouseenter: "mouseover",
    mouseleave: "mouseout"
  }, function (orig, fix) {
    jQuery.event.special[orig] = {
      setup: function (data) {
        jQuery.event.add(this, fix, data && data.selector ? delegate : withinElement, orig);
      },
      teardown: function (data) {
        jQuery.event.remove(this, fix, data && data.selector ? delegate : withinElement);
      }
    };
  });

  // submit delegation
  if (!jQuery.support.submitBubbles) {

    jQuery.event.special.submit = {
      setup: function (data, namespaces) {
        if (this.nodeName.toLowerCase() !== "form") {
          jQuery.event.add(this, "click.specialSubmit", function (e) {
            var elem = e.target,
						type = elem.type;

            if ((type === "submit" || type === "image") && jQuery(elem).closest("form").length) {
              e.liveFired = undefined;
              return trigger("submit", this, arguments);
            }
          });

          jQuery.event.add(this, "keypress.specialSubmit", function (e) {
            var elem = e.target,
						type = elem.type;

            if ((type === "text" || type === "password") && jQuery(elem).closest("form").length && e.keyCode === 13) {
              e.liveFired = undefined;
              return trigger("submit", this, arguments);
            }
          });

        } else {
          return false;
        }
      },

      teardown: function (namespaces) {
        jQuery.event.remove(this, ".specialSubmit");
      }
    };

  }

  // change delegation, happens here so we have bind.
  if (!jQuery.support.changeBubbles) {

    var changeFilters,

	getVal = function (elem) {
	  var type = elem.type, val = elem.value;

	  if (type === "radio" || type === "checkbox") {
	    val = elem.checked;

	  } else if (type === "select-multiple") {
	    val = elem.selectedIndex > -1 ?
				jQuery.map(elem.options, function (elem) {
				  return elem.selected;
				}).join("-") :
				"";

	  } else if (elem.nodeName.toLowerCase() === "select") {
	    val = elem.selectedIndex;
	  }

	  return val;
	},

	testChange = function testChange(e) {
	  var elem = e.target, data, val;

	  if (!rformElems.test(elem.nodeName) || elem.readOnly) {
	    return;
	  }

	  data = jQuery.data(elem, "_change_data");
	  val = getVal(elem);

	  // the current data will be also retrieved by beforeactivate
	  if (e.type !== "focusout" || elem.type !== "radio") {
	    jQuery.data(elem, "_change_data", val);
	  }

	  if (data === undefined || val === data) {
	    return;
	  }

	  if (data != null || val) {
	    e.type = "change";
	    e.liveFired = undefined;
	    return jQuery.event.trigger(e, arguments[1], elem);
	  }
	};

    jQuery.event.special.change = {
      filters: {
        focusout: testChange,

        beforedeactivate: testChange,

        click: function (e) {
          var elem = e.target, type = elem.type;

          if (type === "radio" || type === "checkbox" || elem.nodeName.toLowerCase() === "select") {
            return testChange.call(this, e);
          }
        },

        // Change has to be called before submit
        // Keydown will be called before keypress, which is used in submit-event delegation
        keydown: function (e) {
          var elem = e.target, type = elem.type;

          if ((e.keyCode === 13 && elem.nodeName.toLowerCase() !== "textarea") ||
					(e.keyCode === 32 && (type === "checkbox" || type === "radio")) ||
					type === "select-multiple") {
            return testChange.call(this, e);
          }
        },

        // Beforeactivate happens also before the previous element is blurred
        // with this event you can't trigger a change event, but you can store
        // information
        beforeactivate: function (e) {
          var elem = e.target;
          jQuery.data(elem, "_change_data", getVal(elem));
        }
      },

      setup: function (data, namespaces) {
        if (this.type === "file") {
          return false;
        }

        for (var type in changeFilters) {
          jQuery.event.add(this, type + ".specialChange", changeFilters[type]);
        }

        return rformElems.test(this.nodeName);
      },

      teardown: function (namespaces) {
        jQuery.event.remove(this, ".specialChange");

        return rformElems.test(this.nodeName);
      }
    };

    changeFilters = jQuery.event.special.change.filters;

    // Handle when the input is .focus()'d
    changeFilters.focus = changeFilters.beforeactivate;
  }

  function trigger(type, elem, args) {
    args[0].type = type;
    return jQuery.event.handle.apply(elem, args);
  }

  // Create "bubbling" focus and blur events
  if (document.addEventListener) {
    jQuery.each({ focus: "focusin", blur: "focusout" }, function (orig, fix) {
      jQuery.event.special[fix] = {
        setup: function () {
          if (focusCounts[fix]++ === 0) {
            document.addEventListener(orig, handler, true);
          }
        },
        teardown: function () {
          if (--focusCounts[fix] === 0) {
            document.removeEventListener(orig, handler, true);
          }
        }
      };

      function handler(e) {
        e = jQuery.event.fix(e);
        e.type = fix;
        return jQuery.event.trigger(e, null, e.target);
      }
    });
  }

  jQuery.each(["bind", "one"], function (i, name) {
    jQuery.fn[name] = function (type, data, fn) {
      // Handle object literals
      if (typeof type === "object") {
        for (var key in type) {
          this[name](key, data, type[key], fn);
        }
        return this;
      }

      if (jQuery.isFunction(data) || data === false) {
        fn = data;
        data = undefined;
      }

      var handler = name === "one" ? jQuery.proxy(fn, function (event) {
        jQuery(this).unbind(event, handler);
        return fn.apply(this, arguments);
      }) : fn;

      if (type === "unload" && name !== "one") {
        this.one(type, data, fn);

      } else {
        for (var i = 0, l = this.length; i < l; i++) {
          jQuery.event.add(this[i], type, handler, data);
        }
      }

      return this;
    };
  });

  jQuery.fn.extend({
    unbind: function (type, fn) {
      // Handle object literals
      if (typeof type === "object" && !type.preventDefault) {
        for (var key in type) {
          this.unbind(key, type[key]);
        }

      } else {
        for (var i = 0, l = this.length; i < l; i++) {
          jQuery.event.remove(this[i], type, fn);
        }
      }

      return this;
    },

    delegate: function (selector, types, data, fn) {
      return this.live(types, data, fn, selector);
    },

    undelegate: function (selector, types, fn) {
      if (arguments.length === 0) {
        return this.unbind("live");

      } else {
        return this.die(types, null, fn, selector);
      }
    },

    trigger: function (type, data) {
      return this.each(function () {
        jQuery.event.trigger(type, data, this);
      });
    },

    triggerHandler: function (type, data) {
      if (this[0]) {
        var event = jQuery.Event(type);
        event.preventDefault();
        event.stopPropagation();
        jQuery.event.trigger(event, data, this[0]);
        return event.result;
      }
    },

    toggle: function (fn) {
      // Save reference to arguments for access in closure
      var args = arguments,
			i = 1;

      // link all the functions, so any of them can unbind this click handler
      while (i < args.length) {
        jQuery.proxy(fn, args[i++]);
      }

      return this.click(jQuery.proxy(fn, function (event) {
        // Figure out which function to execute
        var lastToggle = (jQuery.data(this, "lastToggle" + fn.guid) || 0) % i;
        jQuery.data(this, "lastToggle" + fn.guid, lastToggle + 1);

        // Make sure that clicks stop
        event.preventDefault();

        // and execute the function
        return args[lastToggle].apply(this, arguments) || false;
      }));
    },

    hover: function (fnOver, fnOut) {
      return this.mouseenter(fnOver).mouseleave(fnOut || fnOver);
    }
  });

  var liveMap = {
    focus: "focusin",
    blur: "focusout",
    mouseenter: "mouseover",
    mouseleave: "mouseout"
  };

  jQuery.each(["live", "die"], function (i, name) {
    jQuery.fn[name] = function (types, data, fn, origSelector /* Internal Use Only */) {
      var type, i = 0, match, namespaces, preType,
			selector = origSelector || this.selector,
			context = origSelector ? this : jQuery(this.context);

      if (typeof types === "object" && !types.preventDefault) {
        for (var key in types) {
          context[name](key, data, types[key], selector);
        }

        return this;
      }

      if (jQuery.isFunction(data)) {
        fn = data;
        data = undefined;
      }

      types = (types || "").split(" ");

      while ((type = types[i++]) != null) {
        match = rnamespaces.exec(type);
        namespaces = "";

        if (match) {
          namespaces = match[0];
          type = type.replace(rnamespaces, "");
        }

        if (type === "hover") {
          types.push("mouseenter" + namespaces, "mouseleave" + namespaces);
          continue;
        }

        preType = type;

        if (type === "focus" || type === "blur") {
          types.push(liveMap[type] + namespaces);
          type = type + namespaces;

        } else {
          type = (liveMap[type] || type) + namespaces;
        }

        if (name === "live") {
          // bind live handler
          for (var j = 0, l = context.length; j < l; j++) {
            jQuery.event.add(context[j], "live." + liveConvert(type, selector),
						{ data: data, selector: selector, handler: fn, origType: type, origHandler: fn, preType: preType });
          }

        } else {
          // unbind live handler
          context.unbind("live." + liveConvert(type, selector), fn);
        }
      }

      return this;
    };
  });

  function liveHandler(event) {
    var stop, maxLevel, related, match, handleObj, elem, j, i, l, data, close, namespace, ret,
		elems = [],
		selectors = [],
		events = jQuery.data(this, this.nodeType ? "events" : "__events__");

    if (typeof events === "function") {
      events = events.events;
    }

    // Make sure we avoid non-left-click bubbling in Firefox (#3861)
    if (event.liveFired === this || !events || !events.live || event.button && event.type === "click") {
      return;
    }

    if (event.namespace) {
      namespace = new RegExp("(^|\\.)" + event.namespace.split(".").join("\\.(?:.*\\.)?") + "(\\.|$)");
    }

    event.liveFired = this;

    var live = events.live.slice(0);

    for (j = 0; j < live.length; j++) {
      handleObj = live[j];

      if (handleObj.origType.replace(rnamespaces, "") === event.type) {
        selectors.push(handleObj.selector);

      } else {
        live.splice(j--, 1);
      }
    }

    match = jQuery(event.target).closest(selectors, event.currentTarget);

    for (i = 0, l = match.length; i < l; i++) {
      close = match[i];

      for (j = 0; j < live.length; j++) {
        handleObj = live[j];

        if (close.selector === handleObj.selector && (!namespace || namespace.test(handleObj.namespace))) {
          elem = close.elem;
          related = null;

          // Those two events require additional checking
          if (handleObj.preType === "mouseenter" || handleObj.preType === "mouseleave") {
            event.type = handleObj.preType;
            related = jQuery(event.relatedTarget).closest(handleObj.selector)[0];
          }

          if (!related || related !== elem) {
            elems.push({ elem: elem, handleObj: handleObj, level: close.level });
          }
        }
      }
    }

    for (i = 0, l = elems.length; i < l; i++) {
      match = elems[i];

      if (maxLevel && match.level > maxLevel) {
        break;
      }

      event.currentTarget = match.elem;
      event.data = match.handleObj.data;
      event.handleObj = match.handleObj;

      ret = match.handleObj.origHandler.apply(match.elem, arguments);

      if (ret === false || event.isPropagationStopped()) {
        maxLevel = match.level;

        if (ret === false) {
          stop = false;
        }
        if (event.isImmediatePropagationStopped()) {
          break;
        }
      }
    }

    return stop;
  }

  function liveConvert(type, selector) {
    return (type && type !== "*" ? type + "." : "") + selector.replace(rperiod, "`").replace(rspace, "&");
  }

  jQuery.each(("blur focus focusin focusout load resize scroll unload click dblclick " +
	"mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave " +
	"change select submit keydown keypress keyup error").split(" "), function (i, name) {

	  // Handle event binding
	  jQuery.fn[name] = function (data, fn) {
	    if (fn == null) {
	      fn = data;
	      data = null;
	    }

	    return arguments.length > 0 ?
			this.bind(name, data, fn) :
			this.trigger(name);
	  };

	  if (jQuery.attrFn) {
	    jQuery.attrFn[name] = true;
	  }
	});

  // Prevent memory leaks in IE
  // Window isn't included so as not to unbind existing unload events
  // More info:
  //  - http://isaacschlueter.com/2006/10/msie-memory-leaks/
  if (window.attachEvent && !window.addEventListener) {
    jQuery(window).bind("unload", function () {
      for (var id in jQuery.cache) {
        if (jQuery.cache[id].handle) {
          // Try/Catch is to handle iframes being unloaded, see #4280
          try {
            jQuery.event.remove(jQuery.cache[id].handle.elem);
          } catch (e) { }
        }
      }
    });
  }


  /*!
  * Sizzle CSS Selector Engine - v1.0
  *  Copyright 2009, The Dojo Foundation
  *  Released under the MIT, BSD, and GPL Licenses.
  *  More information: http://sizzlejs.com/
  */
  (function () {

    var chunker = /((?:\((?:\([^()]+\)|[^()]+)+\)|\[(?:\[[^\[\]]*\]|['"][^'"]*['"]|[^\[\]'"]+)+\]|\\.|[^ >+~,(\[\\]+)+|[>+~])(\s*,\s*)?((?:.|\r|\n)*)/g,
	done = 0,
	toString = Object.prototype.toString,
	hasDuplicate = false,
	baseHasDuplicate = true;

    // Here we check if the JavaScript engine is using some sort of
    // optimization where it does not always call our comparision
    // function. If that is the case, discard the hasDuplicate value.
    //   Thus far that includes Google Chrome.
    [0, 0].sort(function () {
      baseHasDuplicate = false;
      return 0;
    });

    var Sizzle = function (selector, context, results, seed) {
      results = results || [];
      context = context || document;

      var origContext = context;

      if (context.nodeType !== 1 && context.nodeType !== 9) {
        return [];
      }

      if (!selector || typeof selector !== "string") {
        return results;
      }

      var m, set, checkSet, extra, ret, cur, pop, i,
		prune = true,
		contextXML = Sizzle.isXML(context),
		parts = [],
		soFar = selector;

      // Reset the position of the chunker regexp (start from head)
      do {
        chunker.exec("");
        m = chunker.exec(soFar);

        if (m) {
          soFar = m[3];

          parts.push(m[1]);

          if (m[2]) {
            extra = m[3];
            break;
          }
        }
      } while (m);

      if (parts.length > 1 && origPOS.exec(selector)) {

        if (parts.length === 2 && Expr.relative[parts[0]]) {
          set = posProcess(parts[0] + parts[1], context);

        } else {
          set = Expr.relative[parts[0]] ?
				[context] :
				Sizzle(parts.shift(), context);

          while (parts.length) {
            selector = parts.shift();

            if (Expr.relative[selector]) {
              selector += parts.shift();
            }

            set = posProcess(selector, set);
          }
        }

      } else {
        // Take a shortcut and set the context if the root selector is an ID
        // (but not if it'll be faster if the inner selector is an ID)
        if (!seed && parts.length > 1 && context.nodeType === 9 && !contextXML &&
				Expr.match.ID.test(parts[0]) && !Expr.match.ID.test(parts[parts.length - 1])) {

          ret = Sizzle.find(parts.shift(), context, contextXML);
          context = ret.expr ?
				Sizzle.filter(ret.expr, ret.set)[0] :
				ret.set[0];
        }

        if (context) {
          ret = seed ?
				{ expr: parts.pop(), set: makeArray(seed)} :
				Sizzle.find(parts.pop(), parts.length === 1 && (parts[0] === "~" || parts[0] === "+") && context.parentNode ? context.parentNode : context, contextXML);

          set = ret.expr ?
				Sizzle.filter(ret.expr, ret.set) :
				ret.set;

          if (parts.length > 0) {
            checkSet = makeArray(set);

          } else {
            prune = false;
          }

          while (parts.length) {
            cur = parts.pop();
            pop = cur;

            if (!Expr.relative[cur]) {
              cur = "";
            } else {
              pop = parts.pop();
            }

            if (pop == null) {
              pop = context;
            }

            Expr.relative[cur](checkSet, pop, contextXML);
          }

        } else {
          checkSet = parts = [];
        }
      }

      if (!checkSet) {
        checkSet = set;
      }

      if (!checkSet) {
        Sizzle.error(cur || selector);
      }

      if (toString.call(checkSet) === "[object Array]") {
        if (!prune) {
          results.push.apply(results, checkSet);

        } else if (context && context.nodeType === 1) {
          for (i = 0; checkSet[i] != null; i++) {
            if (checkSet[i] && (checkSet[i] === true || checkSet[i].nodeType === 1 && Sizzle.contains(context, checkSet[i]))) {
              results.push(set[i]);
            }
          }

        } else {
          for (i = 0; checkSet[i] != null; i++) {
            if (checkSet[i] && checkSet[i].nodeType === 1) {
              results.push(set[i]);
            }
          }
        }

      } else {
        makeArray(checkSet, results);
      }

      if (extra) {
        Sizzle(extra, origContext, results, seed);
        Sizzle.uniqueSort(results);
      }

      return results;
    };

    Sizzle.uniqueSort = function (results) {
      if (sortOrder) {
        hasDuplicate = baseHasDuplicate;
        results.sort(sortOrder);

        if (hasDuplicate) {
          for (var i = 1; i < results.length; i++) {
            if (results[i] === results[i - 1]) {
              results.splice(i--, 1);
            }
          }
        }
      }

      return results;
    };

    Sizzle.matches = function (expr, set) {
      return Sizzle(expr, null, null, set);
    };

    Sizzle.matchesSelector = function (node, expr) {
      return Sizzle(expr, null, null, [node]).length > 0;
    };

    Sizzle.find = function (expr, context, isXML) {
      var set;

      if (!expr) {
        return [];
      }

      for (var i = 0, l = Expr.order.length; i < l; i++) {
        var match,
			type = Expr.order[i];

        if ((match = Expr.leftMatch[type].exec(expr))) {
          var left = match[1];
          match.splice(1, 1);

          if (left.substr(left.length - 1) !== "\\") {
            match[1] = (match[1] || "").replace(/\\/g, "");
            set = Expr.find[type](match, context, isXML);

            if (set != null) {
              expr = expr.replace(Expr.match[type], "");
              break;
            }
          }
        }
      }

      if (!set) {
        set = context.getElementsByTagName("*");
      }

      return { set: set, expr: expr };
    };

    Sizzle.filter = function (expr, set, inplace, not) {
      var match, anyFound,
		old = expr,
		result = [],
		curLoop = set,
		isXMLFilter = set && set[0] && Sizzle.isXML(set[0]);

      while (expr && set.length) {
        for (var type in Expr.filter) {
          if ((match = Expr.leftMatch[type].exec(expr)) != null && match[2]) {
            var found, item,
					filter = Expr.filter[type],
					left = match[1];

            anyFound = false;

            match.splice(1, 1);

            if (left.substr(left.length - 1) === "\\") {
              continue;
            }

            if (curLoop === result) {
              result = [];
            }

            if (Expr.preFilter[type]) {
              match = Expr.preFilter[type](match, curLoop, inplace, result, not, isXMLFilter);

              if (!match) {
                anyFound = found = true;

              } else if (match === true) {
                continue;
              }
            }

            if (match) {
              for (var i = 0; (item = curLoop[i]) != null; i++) {
                if (item) {
                  found = filter(item, match, i, curLoop);
                  var pass = not ^ !!found;

                  if (inplace && found != null) {
                    if (pass) {
                      anyFound = true;

                    } else {
                      curLoop[i] = false;
                    }

                  } else if (pass) {
                    result.push(item);
                    anyFound = true;
                  }
                }
              }
            }

            if (found !== undefined) {
              if (!inplace) {
                curLoop = result;
              }

              expr = expr.replace(Expr.match[type], "");

              if (!anyFound) {
                return [];
              }

              break;
            }
          }
        }

        // Improper expression
        if (expr === old) {
          if (anyFound == null) {
            Sizzle.error(expr);

          } else {
            break;
          }
        }

        old = expr;
      }

      return curLoop;
    };

    Sizzle.error = function (msg) {
      throw "Syntax error, unrecognized expression: " + msg;
    };

    var Expr = Sizzle.selectors = {
      order: ["ID", "NAME", "TAG"],

      match: {
        ID: /#((?:[\w\u00c0-\uFFFF\-]|\\.)+)/,
        CLASS: /\.((?:[\w\u00c0-\uFFFF\-]|\\.)+)/,
        NAME: /\[name=['"]*((?:[\w\u00c0-\uFFFF\-]|\\.)+)['"]*\]/,
        ATTR: /\[\s*((?:[\w\u00c0-\uFFFF\-]|\\.)+)\s*(?:(\S?=)\s*(['"]*)(.*?)\3|)\s*\]/,
        TAG: /^((?:[\w\u00c0-\uFFFF\*\-]|\\.)+)/,
        CHILD: /:(only|nth|last|first)-child(?:\((even|odd|[\dn+\-]*)\))?/,
        POS: /:(nth|eq|gt|lt|first|last|even|odd)(?:\((\d*)\))?(?=[^\-]|$)/,
        PSEUDO: /:((?:[\w\u00c0-\uFFFF\-]|\\.)+)(?:\((['"]?)((?:\([^\)]+\)|[^\(\)]*)+)\2\))?/
      },

      leftMatch: {},

      attrMap: {
        "class": "className",
        "for": "htmlFor"
      },

      attrHandle: {
        href: function (elem) {
          return elem.getAttribute("href");
        }
      },

      relative: {
        "+": function (checkSet, part) {
          var isPartStr = typeof part === "string",
				isTag = isPartStr && !/\W/.test(part),
				isPartStrNotTag = isPartStr && !isTag;

          if (isTag) {
            part = part.toLowerCase();
          }

          for (var i = 0, l = checkSet.length, elem; i < l; i++) {
            if ((elem = checkSet[i])) {
              while ((elem = elem.previousSibling) && elem.nodeType !== 1) { }

              checkSet[i] = isPartStrNotTag || elem && elem.nodeName.toLowerCase() === part ?
						elem || false :
						elem === part;
            }
          }

          if (isPartStrNotTag) {
            Sizzle.filter(part, checkSet, true);
          }
        },

        ">": function (checkSet, part) {
          var elem,
				isPartStr = typeof part === "string",
				i = 0,
				l = checkSet.length;

          if (isPartStr && !/\W/.test(part)) {
            part = part.toLowerCase();

            for (; i < l; i++) {
              elem = checkSet[i];

              if (elem) {
                var parent = elem.parentNode;
                checkSet[i] = parent.nodeName.toLowerCase() === part ? parent : false;
              }
            }

          } else {
            for (; i < l; i++) {
              elem = checkSet[i];

              if (elem) {
                checkSet[i] = isPartStr ?
							elem.parentNode :
							elem.parentNode === part;
              }
            }

            if (isPartStr) {
              Sizzle.filter(part, checkSet, true);
            }
          }
        },

        "": function (checkSet, part, isXML) {
          var nodeCheck,
				doneName = done++,
				checkFn = dirCheck;

          if (typeof part === "string" && !/\W/.test(part)) {
            part = part.toLowerCase();
            nodeCheck = part;
            checkFn = dirNodeCheck;
          }

          checkFn("parentNode", part, doneName, checkSet, nodeCheck, isXML);
        },

        "~": function (checkSet, part, isXML) {
          var nodeCheck,
				doneName = done++,
				checkFn = dirCheck;

          if (typeof part === "string" && !/\W/.test(part)) {
            part = part.toLowerCase();
            nodeCheck = part;
            checkFn = dirNodeCheck;
          }

          checkFn("previousSibling", part, doneName, checkSet, nodeCheck, isXML);
        }
      },

      find: {
        ID: function (match, context, isXML) {
          if (typeof context.getElementById !== "undefined" && !isXML) {
            var m = context.getElementById(match[1]);
            // Check parentNode to catch when Blackberry 4.6 returns
            // nodes that are no longer in the document #6963
            return m && m.parentNode ? [m] : [];
          }
        },

        NAME: function (match, context) {
          if (typeof context.getElementsByName !== "undefined") {
            var ret = [],
					results = context.getElementsByName(match[1]);

            for (var i = 0, l = results.length; i < l; i++) {
              if (results[i].getAttribute("name") === match[1]) {
                ret.push(results[i]);
              }
            }

            return ret.length === 0 ? null : ret;
          }
        },

        TAG: function (match, context) {
          return context.getElementsByTagName(match[1]);
        }
      },
      preFilter: {
        CLASS: function (match, curLoop, inplace, result, not, isXML) {
          match = " " + match[1].replace(/\\/g, "") + " ";

          if (isXML) {
            return match;
          }

          for (var i = 0, elem; (elem = curLoop[i]) != null; i++) {
            if (elem) {
              if (not ^ (elem.className && (" " + elem.className + " ").replace(/[\t\n]/g, " ").indexOf(match) >= 0)) {
                if (!inplace) {
                  result.push(elem);
                }

              } else if (inplace) {
                curLoop[i] = false;
              }
            }
          }

          return false;
        },

        ID: function (match) {
          return match[1].replace(/\\/g, "");
        },

        TAG: function (match, curLoop) {
          return match[1].toLowerCase();
        },

        CHILD: function (match) {
          if (match[1] === "nth") {
            // parse equations like 'even', 'odd', '5', '2n', '3n+2', '4n-1', '-n+6'
            var test = /(-?)(\d*)n((?:\+|-)?\d*)/.exec(
					match[2] === "even" && "2n" || match[2] === "odd" && "2n+1" ||
					!/\D/.test(match[2]) && "0n+" + match[2] || match[2]);

            // calculate the numbers (first)n+(last) including if they are negative
            match[2] = (test[1] + (test[2] || 1)) - 0;
            match[3] = test[3] - 0;
          }

          // TODO: Move to normal caching system
          match[0] = done++;

          return match;
        },

        ATTR: function (match, curLoop, inplace, result, not, isXML) {
          var name = match[1].replace(/\\/g, "");

          if (!isXML && Expr.attrMap[name]) {
            match[1] = Expr.attrMap[name];
          }

          if (match[2] === "~=") {
            match[4] = " " + match[4] + " ";
          }

          return match;
        },

        PSEUDO: function (match, curLoop, inplace, result, not) {
          if (match[1] === "not") {
            // If we're dealing with a complex expression, or a simple one
            if ((chunker.exec(match[3]) || "").length > 1 || /^\w/.test(match[3])) {
              match[3] = Sizzle(match[3], null, null, curLoop);

            } else {
              var ret = Sizzle.filter(match[3], curLoop, inplace, true ^ not);

              if (!inplace) {
                result.push.apply(result, ret);
              }

              return false;
            }

          } else if (Expr.match.POS.test(match[0]) || Expr.match.CHILD.test(match[0])) {
            return true;
          }

          return match;
        },

        POS: function (match) {
          match.unshift(true);

          return match;
        }
      },

      filters: {
        enabled: function (elem) {
          return elem.disabled === false && elem.type !== "hidden";
        },

        disabled: function (elem) {
          return elem.disabled === true;
        },

        checked: function (elem) {
          return elem.checked === true;
        },

        selected: function (elem) {
          // Accessing this property makes selected-by-default
          // options in Safari work properly
          elem.parentNode.selectedIndex;

          return elem.selected === true;
        },

        parent: function (elem) {
          return !!elem.firstChild;
        },

        empty: function (elem) {
          return !elem.firstChild;
        },

        has: function (elem, i, match) {
          return !!Sizzle(match[3], elem).length;
        },

        header: function (elem) {
          return (/h\d/i).test(elem.nodeName);
        },

        text: function (elem) {
          return "text" === elem.type;
        },
        radio: function (elem) {
          return "radio" === elem.type;
        },

        checkbox: function (elem) {
          return "checkbox" === elem.type;
        },

        file: function (elem) {
          return "file" === elem.type;
        },
        password: function (elem) {
          return "password" === elem.type;
        },

        submit: function (elem) {
          return "submit" === elem.type;
        },

        image: function (elem) {
          return "image" === elem.type;
        },

        reset: function (elem) {
          return "reset" === elem.type;
        },

        button: function (elem) {
          return "button" === elem.type || elem.nodeName.toLowerCase() === "button";
        },

        input: function (elem) {
          return (/input|select|textarea|button/i).test(elem.nodeName);
        }
      },
      setFilters: {
        first: function (elem, i) {
          return i === 0;
        },

        last: function (elem, i, match, array) {
          return i === array.length - 1;
        },

        even: function (elem, i) {
          return i % 2 === 0;
        },

        odd: function (elem, i) {
          return i % 2 === 1;
        },

        lt: function (elem, i, match) {
          return i < match[3] - 0;
        },

        gt: function (elem, i, match) {
          return i > match[3] - 0;
        },

        nth: function (elem, i, match) {
          return match[3] - 0 === i;
        },

        eq: function (elem, i, match) {
          return match[3] - 0 === i;
        }
      },
      filter: {
        PSEUDO: function (elem, match, i, array) {
          var name = match[1],
				filter = Expr.filters[name];

          if (filter) {
            return filter(elem, i, match, array);

          } else if (name === "contains") {
            return (elem.textContent || elem.innerText || Sizzle.getText([elem]) || "").indexOf(match[3]) >= 0;

          } else if (name === "not") {
            var not = match[3];

            for (var j = 0, l = not.length; j < l; j++) {
              if (not[j] === elem) {
                return false;
              }
            }

            return true;

          } else {
            Sizzle.error("Syntax error, unrecognized expression: " + name);
          }
        },

        CHILD: function (elem, match) {
          var type = match[1],
				node = elem;

          switch (type) {
            case "only":
            case "first":
              while ((node = node.previousSibling)) {
                if (node.nodeType === 1) {
                  return false;
                }
              }

              if (type === "first") {
                return true;
              }

              node = elem;

            case "last":
              while ((node = node.nextSibling)) {
                if (node.nodeType === 1) {
                  return false;
                }
              }

              return true;

            case "nth":
              var first = match[2],
						last = match[3];

              if (first === 1 && last === 0) {
                return true;
              }

              var doneName = match[0],
						parent = elem.parentNode;

              if (parent && (parent.sizcache !== doneName || !elem.nodeIndex)) {
                var count = 0;

                for (node = parent.firstChild; node; node = node.nextSibling) {
                  if (node.nodeType === 1) {
                    node.nodeIndex = ++count;
                  }
                }

                parent.sizcache = doneName;
              }

              var diff = elem.nodeIndex - last;

              if (first === 0) {
                return diff === 0;

              } else {
                return (diff % first === 0 && diff / first >= 0);
              }
          }
        },

        ID: function (elem, match) {
          return elem.nodeType === 1 && elem.getAttribute("id") === match;
        },

        TAG: function (elem, match) {
          return (match === "*" && elem.nodeType === 1) || elem.nodeName.toLowerCase() === match;
        },

        CLASS: function (elem, match) {
          return (" " + (elem.className || elem.getAttribute("class")) + " ")
				.indexOf(match) > -1;
        },

        ATTR: function (elem, match) {
          var name = match[1],
				result = Expr.attrHandle[name] ?
					Expr.attrHandle[name](elem) :
					elem[name] != null ?
						elem[name] :
						elem.getAttribute(name),
				value = result + "",
				type = match[2],
				check = match[4];

          return result == null ?
				type === "!=" :
				type === "=" ?
				value === check :
				type === "*=" ?
				value.indexOf(check) >= 0 :
				type === "~=" ?
				(" " + value + " ").indexOf(check) >= 0 :
				!check ?
				value && result !== false :
				type === "!=" ?
				value !== check :
				type === "^=" ?
				value.indexOf(check) === 0 :
				type === "$=" ?
				value.substr(value.length - check.length) === check :
				type === "|=" ?
				value === check || value.substr(0, check.length + 1) === check + "-" :
				false;
        },

        POS: function (elem, match, i, array) {
          var name = match[2],
				filter = Expr.setFilters[name];

          if (filter) {
            return filter(elem, i, match, array);
          }
        }
      }
    };

    var origPOS = Expr.match.POS,
	fescape = function (all, num) {
	  return "\\" + (num - 0 + 1);
	};

    for (var type in Expr.match) {
      Expr.match[type] = new RegExp(Expr.match[type].source + (/(?![^\[]*\])(?![^\(]*\))/.source));
      Expr.leftMatch[type] = new RegExp(/(^(?:.|\r|\n)*?)/.source + Expr.match[type].source.replace(/\\(\d+)/g, fescape));
    }

    var makeArray = function (array, results) {
      array = Array.prototype.slice.call(array, 0);

      if (results) {
        results.push.apply(results, array);
        return results;
      }

      return array;
    };

    // Perform a simple check to determine if the browser is capable of
    // converting a NodeList to an array using builtin methods.
    // Also verifies that the returned array holds DOM nodes
    // (which is not the case in the Blackberry browser)
    try {
      Array.prototype.slice.call(document.documentElement.childNodes, 0)[0].nodeType;

      // Provide a fallback method if it does not work
    } catch (e) {
      makeArray = function (array, results) {
        var i = 0,
			ret = results || [];

        if (toString.call(array) === "[object Array]") {
          Array.prototype.push.apply(ret, array);

        } else {
          if (typeof array.length === "number") {
            for (var l = array.length; i < l; i++) {
              ret.push(array[i]);
            }

          } else {
            for (; array[i]; i++) {
              ret.push(array[i]);
            }
          }
        }

        return ret;
      };
    }

    var sortOrder, siblingCheck;

    if (document.documentElement.compareDocumentPosition) {
      sortOrder = function (a, b) {
        if (a === b) {
          hasDuplicate = true;
          return 0;
        }

        if (!a.compareDocumentPosition || !b.compareDocumentPosition) {
          return a.compareDocumentPosition ? -1 : 1;
        }

        return a.compareDocumentPosition(b) & 4 ? -1 : 1;
      };

    } else {
      sortOrder = function (a, b) {
        var al, bl,
			ap = [],
			bp = [],
			aup = a.parentNode,
			bup = b.parentNode,
			cur = aup;

        // The nodes are identical, we can exit early
        if (a === b) {
          hasDuplicate = true;
          return 0;

          // If the nodes are siblings (or identical) we can do a quick check
        } else if (aup === bup) {
          return siblingCheck(a, b);

          // If no parents were found then the nodes are disconnected
        } else if (!aup) {
          return -1;

        } else if (!bup) {
          return 1;
        }

        // Otherwise they're somewhere else in the tree so we need
        // to build up a full list of the parentNodes for comparison
        while (cur) {
          ap.unshift(cur);
          cur = cur.parentNode;
        }

        cur = bup;

        while (cur) {
          bp.unshift(cur);
          cur = cur.parentNode;
        }

        al = ap.length;
        bl = bp.length;

        // Start walking down the tree looking for a discrepancy
        for (var i = 0; i < al && i < bl; i++) {
          if (ap[i] !== bp[i]) {
            return siblingCheck(ap[i], bp[i]);
          }
        }

        // We ended someplace up the tree so do a sibling check
        return i === al ?
			siblingCheck(a, bp[i], -1) :
			siblingCheck(ap[i], b, 1);
      };

      siblingCheck = function (a, b, ret) {
        if (a === b) {
          return ret;
        }

        var cur = a.nextSibling;

        while (cur) {
          if (cur === b) {
            return -1;
          }

          cur = cur.nextSibling;
        }

        return 1;
      };
    }

    // Utility function for retreiving the text value of an array of DOM nodes
    Sizzle.getText = function (elems) {
      var ret = "", elem;

      for (var i = 0; elems[i]; i++) {
        elem = elems[i];

        // Get the text from text nodes and CDATA nodes
        if (elem.nodeType === 3 || elem.nodeType === 4) {
          ret += elem.nodeValue;

          // Traverse everything else, except comment nodes
        } else if (elem.nodeType !== 8) {
          ret += Sizzle.getText(elem.childNodes);
        }
      }

      return ret;
    };

    // Check to see if the browser returns elements by name when
    // querying by getElementById (and provide a workaround)
    (function () {
      // We're going to inject a fake input element with a specified name
      var form = document.createElement("div"),
		id = "script" + (new Date()).getTime(),
		root = document.documentElement;

      form.innerHTML = "<a name='" + id + "'/>";

      // Inject it into the root element, check its status, and remove it quickly
      root.insertBefore(form, root.firstChild);

      // The workaround has to do additional checks after a getElementById
      // Which slows things down for other browsers (hence the branching)
      if (document.getElementById(id)) {
        Expr.find.ID = function (match, context, isXML) {
          if (typeof context.getElementById !== "undefined" && !isXML) {
            var m = context.getElementById(match[1]);

            return m ?
					m.id === match[1] || typeof m.getAttributeNode !== "undefined" && m.getAttributeNode("id").nodeValue === match[1] ?
						[m] :
						undefined :
					[];
          }
        };

        Expr.filter.ID = function (elem, match) {
          var node = typeof elem.getAttributeNode !== "undefined" && elem.getAttributeNode("id");

          return elem.nodeType === 1 && node && node.nodeValue === match;
        };
      }

      root.removeChild(form);

      // release memory in IE
      root = form = null;
    })();

    (function () {
      // Check to see if the browser returns only elements
      // when doing getElementsByTagName("*")

      // Create a fake element
      var div = document.createElement("div");
      div.appendChild(document.createComment(""));

      // Make sure no comments are found
      if (div.getElementsByTagName("*").length > 0) {
        Expr.find.TAG = function (match, context) {
          var results = context.getElementsByTagName(match[1]);

          // Filter out possible comments
          if (match[1] === "*") {
            var tmp = [];

            for (var i = 0; results[i]; i++) {
              if (results[i].nodeType === 1) {
                tmp.push(results[i]);
              }
            }

            results = tmp;
          }

          return results;
        };
      }

      // Check to see if an attribute returns normalized href attributes
      div.innerHTML = "<a href='#'></a>";

      if (div.firstChild && typeof div.firstChild.getAttribute !== "undefined" &&
			div.firstChild.getAttribute("href") !== "#") {

        Expr.attrHandle.href = function (elem) {
          return elem.getAttribute("href", 2);
        };
      }

      // release memory in IE
      div = null;
    })();

    if (document.querySelectorAll) {
      (function () {
        var oldSizzle = Sizzle,
			div = document.createElement("div"),
			id = "__sizzle__";

        div.innerHTML = "<p class='TEST'></p>";

        // Safari can't handle uppercase or unicode characters when
        // in quirks mode.
        if (div.querySelectorAll && div.querySelectorAll(".TEST").length === 0) {
          return;
        }

        Sizzle = function (query, context, extra, seed) {
          context = context || document;

          // Make sure that attribute selectors are quoted
          query = query.replace(/\=\s*([^'"\]]*)\s*\]/g, "='$1']");

          // Only use querySelectorAll on non-XML documents
          // (ID selectors don't work in non-HTML documents)
          if (!seed && !Sizzle.isXML(context)) {
            if (context.nodeType === 9) {
              try {
                return makeArray(context.querySelectorAll(query), extra);
              } catch (qsaError) { }

              // qSA works strangely on Element-rooted queries
              // We can work around this by specifying an extra ID on the root
              // and working up from there (Thanks to Andrew Dupont for the technique)
              // IE 8 doesn't work on object elements
            } else if (context.nodeType === 1 && context.nodeName.toLowerCase() !== "object") {
              var old = context.getAttribute("id"),
						nid = old || id;

              if (!old) {
                context.setAttribute("id", nid);
              }

              try {
                return makeArray(context.querySelectorAll("#" + nid + " " + query), extra);

              } catch (pseudoError) {
              } finally {
                if (!old) {
                  context.removeAttribute("id");
                }
              }
            }
          }

          return oldSizzle(query, context, extra, seed);
        };

        for (var prop in oldSizzle) {
          Sizzle[prop] = oldSizzle[prop];
        }

        // release memory in IE
        div = null;
      })();
    }

    (function () {
      var html = document.documentElement,
		matches = html.matchesSelector || html.mozMatchesSelector || html.webkitMatchesSelector || html.msMatchesSelector,
		pseudoWorks = false;

      try {
        // This should fail with an exception
        // Gecko does not error, returns false instead
        matches.call(document.documentElement, "[test!='']:sizzle");

      } catch (pseudoError) {
        pseudoWorks = true;
      }

      if (matches) {
        Sizzle.matchesSelector = function (node, expr) {
          // Make sure that attribute selectors are quoted
          expr = expr.replace(/\=\s*([^'"\]]*)\s*\]/g, "='$1']");

          if (!Sizzle.isXML(node)) {
            try {
              if (pseudoWorks || !Expr.match.PSEUDO.test(expr) && !/!=/.test(expr)) {
                return matches.call(node, expr);
              }
            } catch (e) { }
          }

          return Sizzle(expr, null, null, [node]).length > 0;
        };
      }
    })();

    (function () {
      var div = document.createElement("div");

      div.innerHTML = "<div class='test e'></div><div class='test'></div>";

      // Opera can't find a second classname (in 9.6)
      // Also, make sure that getElementsByClassName actually exists
      if (!div.getElementsByClassName || div.getElementsByClassName("e").length === 0) {
        return;
      }

      // Safari caches class attributes, doesn't catch changes (in 3.2)
      div.lastChild.className = "e";

      if (div.getElementsByClassName("e").length === 1) {
        return;
      }

      Expr.order.splice(1, 0, "CLASS");
      Expr.find.CLASS = function (match, context, isXML) {
        if (typeof context.getElementsByClassName !== "undefined" && !isXML) {
          return context.getElementsByClassName(match[1]);
        }
      };

      // release memory in IE
      div = null;
    })();

    function dirNodeCheck(dir, cur, doneName, checkSet, nodeCheck, isXML) {
      for (var i = 0, l = checkSet.length; i < l; i++) {
        var elem = checkSet[i];

        if (elem) {
          var match = false;

          elem = elem[dir];

          while (elem) {
            if (elem.sizcache === doneName) {
              match = checkSet[elem.sizset];
              break;
            }

            if (elem.nodeType === 1 && !isXML) {
              elem.sizcache = doneName;
              elem.sizset = i;
            }

            if (elem.nodeName.toLowerCase() === cur) {
              match = elem;
              break;
            }

            elem = elem[dir];
          }

          checkSet[i] = match;
        }
      }
    }

    function dirCheck(dir, cur, doneName, checkSet, nodeCheck, isXML) {
      for (var i = 0, l = checkSet.length; i < l; i++) {
        var elem = checkSet[i];

        if (elem) {
          var match = false;

          elem = elem[dir];

          while (elem) {
            if (elem.sizcache === doneName) {
              match = checkSet[elem.sizset];
              break;
            }

            if (elem.nodeType === 1) {
              if (!isXML) {
                elem.sizcache = doneName;
                elem.sizset = i;
              }

              if (typeof cur !== "string") {
                if (elem === cur) {
                  match = true;
                  break;
                }

              } else if (Sizzle.filter(cur, [elem]).length > 0) {
                match = elem;
                break;
              }
            }

            elem = elem[dir];
          }

          checkSet[i] = match;
        }
      }
    }

    if (document.documentElement.contains) {
      Sizzle.contains = function (a, b) {
        return a !== b && (a.contains ? a.contains(b) : true);
      };

    } else if (document.documentElement.compareDocumentPosition) {
      Sizzle.contains = function (a, b) {
        return !!(a.compareDocumentPosition(b) & 16);
      };

    } else {
      Sizzle.contains = function () {
        return false;
      };
    }

    Sizzle.isXML = function (elem) {
      // documentElement is verified for cases where it doesn't yet exist
      // (such as loading iframes in IE - #4833) 
      var documentElement = (elem ? elem.ownerDocument || elem : 0).documentElement;

      return documentElement ? documentElement.nodeName !== "HTML" : false;
    };

    var posProcess = function (selector, context) {
      var match,
		tmpSet = [],
		later = "",
		root = context.nodeType ? [context] : context;

      // Position selectors must be done after the filter
      // And so must :not(positional) so we move all PSEUDOs to the end
      while ((match = Expr.match.PSEUDO.exec(selector))) {
        later += match[0];
        selector = selector.replace(Expr.match.PSEUDO, "");
      }

      selector = Expr.relative[selector] ? selector + "*" : selector;

      for (var i = 0, l = root.length; i < l; i++) {
        Sizzle(selector, root[i], tmpSet);
      }

      return Sizzle.filter(later, tmpSet);
    };

    // EXPOSE
    jQuery.find = Sizzle;
    jQuery.expr = Sizzle.selectors;
    jQuery.expr[":"] = jQuery.expr.filters;
    jQuery.unique = Sizzle.uniqueSort;
    jQuery.text = Sizzle.getText;
    jQuery.isXMLDoc = Sizzle.isXML;
    jQuery.contains = Sizzle.contains;


  })();


  var runtil = /Until$/,
	rparentsprev = /^(?:parents|prevUntil|prevAll)/,
  // Note: This RegExp should be improved, or likely pulled from Sizzle
	rmultiselector = /,/,
	isSimple = /^.[^:#\[\.,]*$/,
	slice = Array.prototype.slice,
	POS = jQuery.expr.match.POS;

  jQuery.fn.extend({
    find: function (selector) {
      var ret = this.pushStack("", "find", selector),
			length = 0;

      for (var i = 0, l = this.length; i < l; i++) {
        length = ret.length;
        jQuery.find(selector, this[i], ret);

        if (i > 0) {
          // Make sure that the results are unique
          for (var n = length; n < ret.length; n++) {
            for (var r = 0; r < length; r++) {
              if (ret[r] === ret[n]) {
                ret.splice(n--, 1);
                break;
              }
            }
          }
        }
      }

      return ret;
    },

    has: function (target) {
      var targets = jQuery(target);
      return this.filter(function () {
        for (var i = 0, l = targets.length; i < l; i++) {
          if (jQuery.contains(this, targets[i])) {
            return true;
          }
        }
      });
    },

    not: function (selector) {
      return this.pushStack(winnow(this, selector, false), "not", selector);
    },

    filter: function (selector) {
      return this.pushStack(winnow(this, selector, true), "filter", selector);
    },

    is: function (selector) {
      return !!selector && jQuery.filter(selector, this).length > 0;
    },

    closest: function (selectors, context) {
      var ret = [], i, l, cur = this[0];

      if (jQuery.isArray(selectors)) {
        var match, selector,
				matches = {},
				level = 1;

        if (cur && selectors.length) {
          for (i = 0, l = selectors.length; i < l; i++) {
            selector = selectors[i];

            if (!matches[selector]) {
              matches[selector] = jQuery.expr.match.POS.test(selector) ?
							jQuery(selector, context || this.context) :
							selector;
            }
          }

          while (cur && cur.ownerDocument && cur !== context) {
            for (selector in matches) {
              match = matches[selector];

              if (match.jquery ? match.index(cur) > -1 : jQuery(cur).is(match)) {
                ret.push({ selector: selector, elem: cur, level: level });
              }
            }

            cur = cur.parentNode;
            level++;
          }
        }

        return ret;
      }

      var pos = POS.test(selectors) ?
			jQuery(selectors, context || this.context) : null;

      for (i = 0, l = this.length; i < l; i++) {
        cur = this[i];

        while (cur) {
          if (pos ? pos.index(cur) > -1 : jQuery.find.matchesSelector(cur, selectors)) {
            ret.push(cur);
            break;

          } else {
            cur = cur.parentNode;
            if (!cur || !cur.ownerDocument || cur === context) {
              break;
            }
          }
        }
      }

      ret = ret.length > 1 ? jQuery.unique(ret) : ret;

      return this.pushStack(ret, "closest", selectors);
    },

    // Determine the position of an element within
    // the matched set of elements
    index: function (elem) {
      if (!elem || typeof elem === "string") {
        return jQuery.inArray(this[0],
        // If it receives a string, the selector is used
        // If it receives nothing, the siblings are used
				elem ? jQuery(elem) : this.parent().children());
      }
      // Locate the position of the desired element
      return jQuery.inArray(
      // If it receives a jQuery object, the first element is used
			elem.jquery ? elem[0] : elem, this);
    },

    add: function (selector, context) {
      var set = typeof selector === "string" ?
				jQuery(selector, context || this.context) :
				jQuery.makeArray(selector),
			all = jQuery.merge(this.get(), set);

      return this.pushStack(isDisconnected(set[0]) || isDisconnected(all[0]) ?
			all :
			jQuery.unique(all));
    },

    andSelf: function () {
      return this.add(this.prevObject);
    }
  });

  // A painfully simple check to see if an element is disconnected
  // from a document (should be improved, where feasible).
  function isDisconnected(node) {
    return !node || !node.parentNode || node.parentNode.nodeType === 11;
  }

  jQuery.each({
    parent: function (elem) {
      var parent = elem.parentNode;
      return parent && parent.nodeType !== 11 ? parent : null;
    },
    parents: function (elem) {
      return jQuery.dir(elem, "parentNode");
    },
    parentsUntil: function (elem, i, until) {
      return jQuery.dir(elem, "parentNode", until);
    },
    next: function (elem) {
      return jQuery.nth(elem, 2, "nextSibling");
    },
    prev: function (elem) {
      return jQuery.nth(elem, 2, "previousSibling");
    },
    nextAll: function (elem) {
      return jQuery.dir(elem, "nextSibling");
    },
    prevAll: function (elem) {
      return jQuery.dir(elem, "previousSibling");
    },
    nextUntil: function (elem, i, until) {
      return jQuery.dir(elem, "nextSibling", until);
    },
    prevUntil: function (elem, i, until) {
      return jQuery.dir(elem, "previousSibling", until);
    },
    siblings: function (elem) {
      return jQuery.sibling(elem.parentNode.firstChild, elem);
    },
    children: function (elem) {
      return jQuery.sibling(elem.firstChild);
    },
    contents: function (elem) {
      return jQuery.nodeName(elem, "iframe") ?
			elem.contentDocument || elem.contentWindow.document :
			jQuery.makeArray(elem.childNodes);
    }
  }, function (name, fn) {
    jQuery.fn[name] = function (until, selector) {
      var ret = jQuery.map(this, fn, until);

      if (!runtil.test(name)) {
        selector = until;
      }

      if (selector && typeof selector === "string") {
        ret = jQuery.filter(selector, ret);
      }

      ret = this.length > 1 ? jQuery.unique(ret) : ret;

      if ((this.length > 1 || rmultiselector.test(selector)) && rparentsprev.test(name)) {
        ret = ret.reverse();
      }

      return this.pushStack(ret, name, slice.call(arguments).join(","));
    };
  });

  jQuery.extend({
    filter: function (expr, elems, not) {
      if (not) {
        expr = ":not(" + expr + ")";
      }

      return elems.length === 1 ?
			jQuery.find.matchesSelector(elems[0], expr) ? [elems[0]] : [] :
			jQuery.find.matches(expr, elems);
    },

    dir: function (elem, dir, until) {
      var matched = [],
			cur = elem[dir];

      while (cur && cur.nodeType !== 9 && (until === undefined || cur.nodeType !== 1 || !jQuery(cur).is(until))) {
        if (cur.nodeType === 1) {
          matched.push(cur);
        }
        cur = cur[dir];
      }
      return matched;
    },

    nth: function (cur, result, dir, elem) {
      result = result || 1;
      var num = 0;

      for (; cur; cur = cur[dir]) {
        if (cur.nodeType === 1 && ++num === result) {
          break;
        }
      }

      return cur;
    },

    sibling: function (n, elem) {
      var r = [];

      for (; n; n = n.nextSibling) {
        if (n.nodeType === 1 && n !== elem) {
          r.push(n);
        }
      }

      return r;
    }
  });

  // Implement the identical functionality for filter and not
  function winnow(elements, qualifier, keep) {
    if (jQuery.isFunction(qualifier)) {
      return jQuery.grep(elements, function (elem, i) {
        var retVal = !!qualifier.call(elem, i, elem);
        return retVal === keep;
      });

    } else if (qualifier.nodeType) {
      return jQuery.grep(elements, function (elem, i) {
        return (elem === qualifier) === keep;
      });

    } else if (typeof qualifier === "string") {
      var filtered = jQuery.grep(elements, function (elem) {
        return elem.nodeType === 1;
      });

      if (isSimple.test(qualifier)) {
        return jQuery.filter(qualifier, filtered, !keep);
      } else {
        qualifier = jQuery.filter(qualifier, filtered);
      }
    }

    return jQuery.grep(elements, function (elem, i) {
      return (jQuery.inArray(elem, qualifier) >= 0) === keep;
    });
  }




  var rinlinejQuery = / jQuery\d+="(?:\d+|null)"/g,
	rleadingWhitespace = /^\s+/,
	rxhtmlTag = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/ig,
	rtagName = /<([\w:]+)/,
	rtbody = /<tbody/i,
	rhtml = /<|&#?\w+;/,
	rnocache = /<(?:script|object|embed|option|style)/i,
  // checked="checked" or checked (html5)
	rchecked = /checked\s*(?:[^=]|=\s*.checked.)/i,
	raction = /\=([^="'>\s]+\/)>/g,
	wrapMap = {
	  option: [1, "<select multiple='multiple'>", "</select>"],
	  legend: [1, "<fieldset>", "</fieldset>"],
	  thead: [1, "<table>", "</table>"],
	  tr: [2, "<table><tbody>", "</tbody></table>"],
	  td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
	  col: [2, "<table><tbody></tbody><colgroup>", "</colgroup></table>"],
	  area: [1, "<map>", "</map>"],
	  _default: [0, "", ""]
	};

  wrapMap.optgroup = wrapMap.option;
  wrapMap.tbody = wrapMap.tfoot = wrapMap.colgroup = wrapMap.caption = wrapMap.thead;
  wrapMap.th = wrapMap.td;

  // IE can't serialize <link> and <script> tags normally
  if (!jQuery.support.htmlSerialize) {
    wrapMap._default = [1, "div<div>", "</div>"];
  }

  jQuery.fn.extend({
    text: function (text) {
      if (jQuery.isFunction(text)) {
        return this.each(function (i) {
          var self = jQuery(this);

          self.text(text.call(this, i, self.text()));
        });
      }

      if (typeof text !== "object" && text !== undefined) {
        return this.empty().append((this[0] && this[0].ownerDocument || document).createTextNode(text));
      }

      return jQuery.text(this);
    },

    wrapAll: function (html) {
      if (jQuery.isFunction(html)) {
        return this.each(function (i) {
          jQuery(this).wrapAll(html.call(this, i));
        });
      }

      if (this[0]) {
        // The elements to wrap the target around
        var wrap = jQuery(html, this[0].ownerDocument).eq(0).clone(true);

        if (this[0].parentNode) {
          wrap.insertBefore(this[0]);
        }

        wrap.map(function () {
          var elem = this;

          while (elem.firstChild && elem.firstChild.nodeType === 1) {
            elem = elem.firstChild;
          }

          return elem;
        }).append(this);
      }

      return this;
    },

    wrapInner: function (html) {
      if (jQuery.isFunction(html)) {
        return this.each(function (i) {
          jQuery(this).wrapInner(html.call(this, i));
        });
      }

      return this.each(function () {
        var self = jQuery(this),
				contents = self.contents();

        if (contents.length) {
          contents.wrapAll(html);

        } else {
          self.append(html);
        }
      });
    },

    wrap: function (html) {
      return this.each(function () {
        jQuery(this).wrapAll(html);
      });
    },

    unwrap: function () {
      return this.parent().each(function () {
        if (!jQuery.nodeName(this, "body")) {
          jQuery(this).replaceWith(this.childNodes);
        }
      }).end();
    },

    append: function () {
      return this.domManip(arguments, true, function (elem) {
        if (this.nodeType === 1) {
          this.appendChild(elem);
        }
      });
    },

    prepend: function () {
      return this.domManip(arguments, true, function (elem) {
        if (this.nodeType === 1) {
          this.insertBefore(elem, this.firstChild);
        }
      });
    },

    before: function () {
      if (this[0] && this[0].parentNode) {
        return this.domManip(arguments, false, function (elem) {
          this.parentNode.insertBefore(elem, this);
        });
      } else if (arguments.length) {
        var set = jQuery(arguments[0]);
        set.push.apply(set, this.toArray());
        return this.pushStack(set, "before", arguments);
      }
    },

    after: function () {
      if (this[0] && this[0].parentNode) {
        return this.domManip(arguments, false, function (elem) {
          this.parentNode.insertBefore(elem, this.nextSibling);
        });
      } else if (arguments.length) {
        var set = this.pushStack(this, "after", arguments);
        set.push.apply(set, jQuery(arguments[0]).toArray());
        return set;
      }
    },

    // keepData is for internal use only--do not document
    remove: function (selector, keepData) {
      for (var i = 0, elem; (elem = this[i]) != null; i++) {
        if (!selector || jQuery.filter(selector, [elem]).length) {
          if (!keepData && elem.nodeType === 1) {
            jQuery.cleanData(elem.getElementsByTagName("*"));
            jQuery.cleanData([elem]);
          }

          if (elem.parentNode) {
            elem.parentNode.removeChild(elem);
          }
        }
      }

      return this;
    },

    empty: function () {
      for (var i = 0, elem; (elem = this[i]) != null; i++) {
        // Remove element nodes and prevent memory leaks
        if (elem.nodeType === 1) {
          jQuery.cleanData(elem.getElementsByTagName("*"));
        }

        // Remove any remaining nodes
        while (elem.firstChild) {
          elem.removeChild(elem.firstChild);
        }
      }

      return this;
    },

    clone: function (events) {
      // Do the clone
      var ret = this.map(function () {
        if (!jQuery.support.noCloneEvent && !jQuery.isXMLDoc(this)) {
          // IE copies events bound via attachEvent when
          // using cloneNode. Calling detachEvent on the
          // clone will also remove the events from the orignal
          // In order to get around this, we use innerHTML.
          // Unfortunately, this means some modifications to
          // attributes in IE that are actually only stored
          // as properties will not be copied (such as the
          // the name attribute on an input).
          var html = this.outerHTML,
					ownerDocument = this.ownerDocument;

          if (!html) {
            var div = ownerDocument.createElement("div");
            div.appendChild(this.cloneNode(true));
            html = div.innerHTML;
          }

          return jQuery.clean([html.replace(rinlinejQuery, "")
          // Handle the case in IE 8 where action=/test/> self-closes a tag
					.replace(raction, '="$1">')
					.replace(rleadingWhitespace, "")], ownerDocument)[0];
        } else {
          return this.cloneNode(true);
        }
      });

      // Copy the events from the original to the clone
      if (events === true) {
        cloneCopyEvent(this, ret);
        cloneCopyEvent(this.find("*"), ret.find("*"));
      }

      // Return the cloned set
      return ret;
    },

    html: function (value) {
      if (value === undefined) {
        return this[0] && this[0].nodeType === 1 ?
				this[0].innerHTML.replace(rinlinejQuery, "") :
				null;

        // See if we can take a shortcut and just use innerHTML
      } else if (typeof value === "string" && !rnocache.test(value) &&
			(jQuery.support.leadingWhitespace || !rleadingWhitespace.test(value)) &&
			!wrapMap[(rtagName.exec(value) || ["", ""])[1].toLowerCase()]) {

        value = value.replace(rxhtmlTag, "<$1></$2>");

        try {
          for (var i = 0, l = this.length; i < l; i++) {
            // Remove element nodes and prevent memory leaks
            if (this[i].nodeType === 1) {
              jQuery.cleanData(this[i].getElementsByTagName("*"));
              this[i].innerHTML = value;
            }
          }

          // If using innerHTML throws an exception, use the fallback method
        } catch (e) {
          this.empty().append(value);
        }

      } else if (jQuery.isFunction(value)) {
        this.each(function (i) {
          var self = jQuery(this);

          self.html(value.call(this, i, self.html()));
        });

      } else {
        this.empty().append(value);
      }

      return this;
    },

    replaceWith: function (value) {
      if (this[0] && this[0].parentNode) {
        // Make sure that the elements are removed from the DOM before they are inserted
        // this can help fix replacing a parent with child elements
        if (jQuery.isFunction(value)) {
          return this.each(function (i) {
            var self = jQuery(this), old = self.html();
            self.replaceWith(value.call(this, i, old));
          });
        }

        if (typeof value !== "string") {
          value = jQuery(value).detach();
        }

        return this.each(function () {
          var next = this.nextSibling,
					parent = this.parentNode;

          jQuery(this).remove();

          if (next) {
            jQuery(next).before(value);
          } else {
            jQuery(parent).append(value);
          }
        });
      } else {
        return this.pushStack(jQuery(jQuery.isFunction(value) ? value() : value), "replaceWith", value);
      }
    },

    detach: function (selector) {
      return this.remove(selector, true);
    },

    domManip: function (args, table, callback) {
      var results, first, fragment, parent,
			value = args[0],
			scripts = [];

      // We can't cloneNode fragments that contain checked, in WebKit
      if (!jQuery.support.checkClone && arguments.length === 3 && typeof value === "string" && rchecked.test(value)) {
        return this.each(function () {
          jQuery(this).domManip(args, table, callback, true);
        });
      }

      if (jQuery.isFunction(value)) {
        return this.each(function (i) {
          var self = jQuery(this);
          args[0] = value.call(this, i, table ? self.html() : undefined);
          self.domManip(args, table, callback);
        });
      }

      if (this[0]) {
        parent = value && value.parentNode;

        // If we're in a fragment, just use that instead of building a new one
        if (jQuery.support.parentNode && parent && parent.nodeType === 11 && parent.childNodes.length === this.length) {
          results = { fragment: parent };

        } else {
          results = jQuery.buildFragment(args, this, scripts);
        }

        fragment = results.fragment;

        if (fragment.childNodes.length === 1) {
          first = fragment = fragment.firstChild;
        } else {
          first = fragment.firstChild;
        }

        if (first) {
          table = table && jQuery.nodeName(first, "tr");

          for (var i = 0, l = this.length; i < l; i++) {
            callback.call(
						table ?
							root(this[i], first) :
							this[i],
						i > 0 || results.cacheable || this.length > 1 ?
							fragment.cloneNode(true) :
							fragment
					);
          }
        }

        if (scripts.length) {
          jQuery.each(scripts, evalScript);
        }
      }

      return this;
    }
  });

  function root(elem, cur) {
    return jQuery.nodeName(elem, "table") ?
		(elem.getElementsByTagName("tbody")[0] ||
		elem.appendChild(elem.ownerDocument.createElement("tbody"))) :
		elem;
  }

  function cloneCopyEvent(orig, ret) {
    var i = 0;

    ret.each(function () {
      if (this.nodeName !== (orig[i] && orig[i].nodeName)) {
        return;
      }

      var oldData = jQuery.data(orig[i++]),
			curData = jQuery.data(this, oldData),
			events = oldData && oldData.events;

      if (events) {
        delete curData.handle;
        curData.events = {};

        for (var type in events) {
          for (var handler in events[type]) {
            jQuery.event.add(this, type, events[type][handler], events[type][handler].data);
          }
        }
      }
    });
  }

  jQuery.buildFragment = function (args, nodes, scripts) {
    var fragment, cacheable, cacheresults,
		doc = (nodes && nodes[0] ? nodes[0].ownerDocument || nodes[0] : document);

    // Only cache "small" (1/2 KB) strings that are associated with the main document
    // Cloning options loses the selected state, so don't cache them
    // IE 6 doesn't like it when you put <object> or <embed> elements in a fragment
    // Also, WebKit does not clone 'checked' attributes on cloneNode, so don't cache
    if (args.length === 1 && typeof args[0] === "string" && args[0].length < 512 && doc === document &&
		!rnocache.test(args[0]) && (jQuery.support.checkClone || !rchecked.test(args[0]))) {

      cacheable = true;
      cacheresults = jQuery.fragments[args[0]];
      if (cacheresults) {
        if (cacheresults !== 1) {
          fragment = cacheresults;
        }
      }
    }

    if (!fragment) {
      fragment = doc.createDocumentFragment();
      jQuery.clean(args, doc, fragment, scripts);
    }

    if (cacheable) {
      jQuery.fragments[args[0]] = cacheresults ? fragment : 1;
    }

    return { fragment: fragment, cacheable: cacheable };
  };

  jQuery.fragments = {};

  jQuery.each({
    appendTo: "append",
    prependTo: "prepend",
    insertBefore: "before",
    insertAfter: "after",
    replaceAll: "replaceWith"
  }, function (name, original) {
    jQuery.fn[name] = function (selector) {
      var ret = [],
			insert = jQuery(selector),
			parent = this.length === 1 && this[0].parentNode;

      if (parent && parent.nodeType === 11 && parent.childNodes.length === 1 && insert.length === 1) {
        insert[original](this[0]);
        return this;

      } else {
        for (var i = 0, l = insert.length; i < l; i++) {
          var elems = (i > 0 ? this.clone(true) : this).get();
          jQuery(insert[i])[original](elems);
          ret = ret.concat(elems);
        }

        return this.pushStack(ret, name, insert.selector);
      }
    };
  });

  jQuery.extend({
    clean: function (elems, context, fragment, scripts) {
      context = context || document;

      // !context.createElement fails in IE with an error but returns typeof 'object'
      if (typeof context.createElement === "undefined") {
        context = context.ownerDocument || context[0] && context[0].ownerDocument || document;
      }

      var ret = [];

      for (var i = 0, elem; (elem = elems[i]) != null; i++) {
        if (typeof elem === "number") {
          elem += "";
        }

        if (!elem) {
          continue;
        }

        // Convert html string into DOM nodes
        if (typeof elem === "string" && !rhtml.test(elem)) {
          elem = context.createTextNode(elem);

        } else if (typeof elem === "string") {
          // Fix "XHTML"-style tags in all browsers
          elem = elem.replace(rxhtmlTag, "<$1></$2>");

          // Trim whitespace, otherwise indexOf won't work as expected
          var tag = (rtagName.exec(elem) || ["", ""])[1].toLowerCase(),
					wrap = wrapMap[tag] || wrapMap._default,
					depth = wrap[0],
					div = context.createElement("div");

          // Go to html and back, then peel off extra wrappers
          div.innerHTML = wrap[1] + elem + wrap[2];

          // Move to the right depth
          while (depth--) {
            div = div.lastChild;
          }

          // Remove IE's autoinserted <tbody> from table fragments
          if (!jQuery.support.tbody) {

            // String was a <table>, *may* have spurious <tbody>
            var hasBody = rtbody.test(elem),
						tbody = tag === "table" && !hasBody ?
							div.firstChild && div.firstChild.childNodes :

            // String was a bare <thead> or <tfoot>
							wrap[1] === "<table>" && !hasBody ?
								div.childNodes :
								[];

            for (var j = tbody.length - 1; j >= 0; --j) {
              if (jQuery.nodeName(tbody[j], "tbody") && !tbody[j].childNodes.length) {
                tbody[j].parentNode.removeChild(tbody[j]);
              }
            }

          }

          // IE completely kills leading whitespace when innerHTML is used
          if (!jQuery.support.leadingWhitespace && rleadingWhitespace.test(elem)) {
            div.insertBefore(context.createTextNode(rleadingWhitespace.exec(elem)[0]), div.firstChild);
          }

          elem = div.childNodes;
        }

        if (elem.nodeType) {
          ret.push(elem);
        } else {
          ret = jQuery.merge(ret, elem);
        }
      }

      if (fragment) {
        for (i = 0; ret[i]; i++) {
          if (scripts && jQuery.nodeName(ret[i], "script") && (!ret[i].type || ret[i].type.toLowerCase() === "text/javascript")) {
            scripts.push(ret[i].parentNode ? ret[i].parentNode.removeChild(ret[i]) : ret[i]);

          } else {
            if (ret[i].nodeType === 1) {
              ret.splice.apply(ret, [i + 1, 0].concat(jQuery.makeArray(ret[i].getElementsByTagName("script"))));
            }
            fragment.appendChild(ret[i]);
          }
        }
      }

      return ret;
    },

    cleanData: function (elems) {
      var data, id, cache = jQuery.cache,
			special = jQuery.event.special,
			deleteExpando = jQuery.support.deleteExpando;

      for (var i = 0, elem; (elem = elems[i]) != null; i++) {
        if (elem.nodeName && jQuery.noData[elem.nodeName.toLowerCase()]) {
          continue;
        }

        id = elem[jQuery.expando];

        if (id) {
          data = cache[id];

          if (data && data.events) {
            for (var type in data.events) {
              if (special[type]) {
                jQuery.event.remove(elem, type);

              } else {
                jQuery.removeEvent(elem, type, data.handle);
              }
            }
          }

          if (deleteExpando) {
            delete elem[jQuery.expando];

          } else if (elem.removeAttribute) {
            elem.removeAttribute(jQuery.expando);
          }

          delete cache[id];
        }
      }
    }
  });

  function evalScript(i, elem) {
    if (elem.src) {
      jQuery.ajax({
        url: elem.src,
        async: false,
        dataType: "script"
      });
    } else {
      jQuery.globalEval(elem.text || elem.textContent || elem.innerHTML || "");
    }

    if (elem.parentNode) {
      elem.parentNode.removeChild(elem);
    }
  }




  var ralpha = /alpha\([^)]*\)/i,
	ropacity = /opacity=([^)]*)/,
	rdashAlpha = /-([a-z])/ig,
	rupper = /([A-Z])/g,
	rnumpx = /^-?\d+(?:px)?$/i,
	rnum = /^-?\d/,

	cssShow = { position: "absolute", visibility: "hidden", display: "block" },
	cssWidth = ["Left", "Right"],
	cssHeight = ["Top", "Bottom"],
	curCSS,

	getComputedStyle,
	currentStyle,

	fcamelCase = function (all, letter) {
	  return letter.toUpperCase();
	};

  jQuery.fn.css = function (name, value) {
    // Setting 'undefined' is a no-op
    if (arguments.length === 2 && value === undefined) {
      return this;
    }

    return jQuery.access(this, name, value, true, function (elem, name, value) {
      return value !== undefined ?
			jQuery.style(elem, name, value) :
			jQuery.css(elem, name);
    });
  };

  jQuery.extend({
    // Add in style property hooks for overriding the default
    // behavior of getting and setting a style property
    cssHooks: {
      opacity: {
        get: function (elem, computed) {
          if (computed) {
            // We should always get a number back from opacity
            var ret = curCSS(elem, "opacity", "opacity");
            return ret === "" ? "1" : ret;

          } else {
            return elem.style.opacity;
          }
        }
      }
    },

    // Exclude the following css properties to add px
    cssNumber: {
      "zIndex": true,
      "fontWeight": true,
      "opacity": true,
      "zoom": true,
      "lineHeight": true
    },

    // Add in properties whose names you wish to fix before
    // setting or getting the value
    cssProps: {
      // normalize float css property
      "float": jQuery.support.cssFloat ? "cssFloat" : "styleFloat"
    },

    // Get and set the style property on a DOM Node
    style: function (elem, name, value, extra) {
      // Don't set styles on text and comment nodes
      if (!elem || elem.nodeType === 3 || elem.nodeType === 8 || !elem.style) {
        return;
      }

      // Make sure that we're working with the right name
      var ret, origName = jQuery.camelCase(name),
			style = elem.style, hooks = jQuery.cssHooks[origName];

      name = jQuery.cssProps[origName] || origName;

      // Check if we're setting a value
      if (value !== undefined) {
        // Make sure that NaN and null values aren't set. See: #7116
        if (typeof value === "number" && isNaN(value) || value == null) {
          return;
        }

        // If a number was passed in, add 'px' to the (except for certain CSS properties)
        if (typeof value === "number" && !jQuery.cssNumber[origName]) {
          value += "px";
        }

        // If a hook was provided, use that value, otherwise just set the specified value
        if (!hooks || !("set" in hooks) || (value = hooks.set(elem, value)) !== undefined) {
          // Wrapped to prevent IE from throwing errors when 'invalid' values are provided
          // Fixes bug #5509
          try {
            style[name] = value;
          } catch (e) { }
        }

      } else {
        // If a hook was provided get the non-computed value from there
        if (hooks && "get" in hooks && (ret = hooks.get(elem, false, extra)) !== undefined) {
          return ret;
        }

        // Otherwise just get the value from the style object
        return style[name];
      }
    },

    css: function (elem, name, extra) {
      // Make sure that we're working with the right name
      var ret, origName = jQuery.camelCase(name),
			hooks = jQuery.cssHooks[origName];

      name = jQuery.cssProps[origName] || origName;

      // If a hook was provided get the computed value from there
      if (hooks && "get" in hooks && (ret = hooks.get(elem, true, extra)) !== undefined) {
        return ret;

        // Otherwise, if a way to get the computed value exists, use that
      } else if (curCSS) {
        return curCSS(elem, name, origName);
      }
    },

    // A method for quickly swapping in/out CSS properties to get correct calculations
    swap: function (elem, options, callback) {
      var old = {};

      // Remember the old values, and insert the new ones
      for (var name in options) {
        old[name] = elem.style[name];
        elem.style[name] = options[name];
      }

      callback.call(elem);

      // Revert the old values
      for (name in options) {
        elem.style[name] = old[name];
      }
    },

    camelCase: function (string) {
      return string.replace(rdashAlpha, fcamelCase);
    }
  });

  // DEPRECATED, Use jQuery.css() instead
  jQuery.curCSS = jQuery.css;

  jQuery.each(["height", "width"], function (i, name) {
    jQuery.cssHooks[name] = {
      get: function (elem, computed, extra) {
        var val;

        if (computed) {
          if (elem.offsetWidth !== 0) {
            val = getWH(elem, name, extra);

          } else {
            jQuery.swap(elem, cssShow, function () {
              val = getWH(elem, name, extra);
            });
          }

          if (val <= 0) {
            val = curCSS(elem, name, name);

            if (val === "0px" && currentStyle) {
              val = currentStyle(elem, name, name);
            }

            if (val != null) {
              // Should return "auto" instead of 0, use 0 for
              // temporary backwards-compat
              return val === "" || val === "auto" ? "0px" : val;
            }
          }

          if (val < 0 || val == null) {
            val = elem.style[name];

            // Should return "auto" instead of 0, use 0 for
            // temporary backwards-compat
            return val === "" || val === "auto" ? "0px" : val;
          }

          return typeof val === "string" ? val : val + "px";
        }
      },

      set: function (elem, value) {
        if (rnumpx.test(value)) {
          // ignore negative width and height values #1599
          value = parseFloat(value);

          if (value >= 0) {
            return value + "px";
          }

        } else {
          return value;
        }
      }
    };
  });

  if (!jQuery.support.opacity) {
    jQuery.cssHooks.opacity = {
      get: function (elem, computed) {
        // IE uses filters for opacity
        return ropacity.test((computed && elem.currentStyle ? elem.currentStyle.filter : elem.style.filter) || "") ?
				(parseFloat(RegExp.$1) / 100) + "" :
				computed ? "1" : "";
      },

      set: function (elem, value) {
        var style = elem.style;

        // IE has trouble with opacity if it does not have layout
        // Force it by setting the zoom level
        style.zoom = 1;

        // Set the alpha filter to set the opacity
        var opacity = jQuery.isNaN(value) ?
				"" :
				"alpha(opacity=" + value * 100 + ")",
				filter = style.filter || "";

        style.filter = ralpha.test(filter) ?
				filter.replace(ralpha, opacity) :
				style.filter + ' ' + opacity;
      }
    };
  }

  if (document.defaultView && document.defaultView.getComputedStyle) {
    getComputedStyle = function (elem, newName, name) {
      var ret, defaultView, computedStyle;

      name = name.replace(rupper, "-$1").toLowerCase();

      if (!(defaultView = elem.ownerDocument.defaultView)) {
        return undefined;
      }

      if ((computedStyle = defaultView.getComputedStyle(elem, null))) {
        ret = computedStyle.getPropertyValue(name);
        if (ret === "" && !jQuery.contains(elem.ownerDocument.documentElement, elem)) {
          ret = jQuery.style(elem, name);
        }
      }

      return ret;
    };
  }

  if (document.documentElement.currentStyle) {
    currentStyle = function (elem, name) {
      var left, rsLeft,
			ret = elem.currentStyle && elem.currentStyle[name],
			style = elem.style;

      // From the awesome hack by Dean Edwards
      // http://erik.eae.net/archives/2007/07/27/18.54.15/#comment-102291

      // If we're not dealing with a regular pixel number
      // but a number that has a weird ending, we need to convert it to pixels
      if (!rnumpx.test(ret) && rnum.test(ret)) {
        // Remember the original values
        left = style.left;
        rsLeft = elem.runtimeStyle.left;

        // Put in the new values to get a computed value out
        elem.runtimeStyle.left = elem.currentStyle.left;
        style.left = name === "fontSize" ? "1em" : (ret || 0);
        ret = style.pixelLeft + "px";

        // Revert the changed values
        style.left = left;
        elem.runtimeStyle.left = rsLeft;
      }

      return ret === "" ? "auto" : ret;
    };
  }

  curCSS = getComputedStyle || currentStyle;

  function getWH(elem, name, extra) {
    var which = name === "width" ? cssWidth : cssHeight,
		val = name === "width" ? elem.offsetWidth : elem.offsetHeight;

    if (extra === "border") {
      return val;
    }

    jQuery.each(which, function () {
      if (!extra) {
        val -= parseFloat(jQuery.css(elem, "padding" + this)) || 0;
      }

      if (extra === "margin") {
        val += parseFloat(jQuery.css(elem, "margin" + this)) || 0;

      } else {
        val -= parseFloat(jQuery.css(elem, "border" + this + "Width")) || 0;
      }
    });

    return val;
  }

  if (jQuery.expr && jQuery.expr.filters) {
    jQuery.expr.filters.hidden = function (elem) {
      var width = elem.offsetWidth,
			height = elem.offsetHeight;

      return (width === 0 && height === 0) || (!jQuery.support.reliableHiddenOffsets && (elem.style.display || jQuery.css(elem, "display")) === "none");
    };

    jQuery.expr.filters.visible = function (elem) {
      return !jQuery.expr.filters.hidden(elem);
    };
  }




  var jsc = jQuery.now(),
	rscript = /<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi,
	rselectTextarea = /^(?:select|textarea)/i,
	rinput = /^(?:color|date|datetime|email|hidden|month|number|password|range|search|tel|text|time|url|week)$/i,
	rnoContent = /^(?:GET|HEAD)$/,
	rbracket = /\[\]$/,
	jsre = /\=\?(&|$)/,
	rquery = /\?/,
	rts = /([?&])_=[^&]*/,
	rurl = /^(\w+:)?\/\/([^\/?#]+)/,
	r20 = /%20/g,
	rhash = /#.*$/,

  // Keep a copy of the old load method
	_load = jQuery.fn.load;

  jQuery.fn.extend({
    load: function (url, params, callback) {
      if (typeof url !== "string" && _load) {
        return _load.apply(this, arguments);

        // Don't do a request if no elements are being requested
      } else if (!this.length) {
        return this;
      }

      var off = url.indexOf(" ");
      if (off >= 0) {
        var selector = url.slice(off, url.length);
        url = url.slice(0, off);
      }

      // Default to a GET request
      var type = "GET";

      // If the second parameter was provided
      if (params) {
        // If it's a function
        if (jQuery.isFunction(params)) {
          // We assume that it's the callback
          callback = params;
          params = null;

          // Otherwise, build a param string
        } else if (typeof params === "object") {
          params = jQuery.param(params, jQuery.ajaxSettings.traditional);
          type = "POST";
        }
      }

      var self = this;

      // Request the remote document
      jQuery.ajax({
        url: url,
        type: type,
        dataType: "html",
        data: params,
        complete: function (res, status) {
          // If successful, inject the HTML into all the matched elements
          if (status === "success" || status === "notmodified") {
            // See if a selector was specified
            self.html(selector ?
            // Create a dummy div to hold the results
						jQuery("<div>")
            // inject the contents of the document in, removing the scripts
            // to avoid any 'Permission Denied' errors in IE
							.append(res.responseText.replace(rscript, ""))

            // Locate the specified elements
							.find(selector) :

            // If not, just inject the full result
						res.responseText);
          }

          if (callback) {
            self.each(callback, [res.responseText, status, res]);
          }
        }
      });

      return this;
    },

    serialize: function () {
      return jQuery.param(this.serializeArray());
    },

    serializeArray: function () {
      return this.map(function () {
        return this.elements ? jQuery.makeArray(this.elements) : this;
      })
		.filter(function () {
		  return this.name && !this.disabled &&
				(this.checked || rselectTextarea.test(this.nodeName) ||
					rinput.test(this.type));
		})
		.map(function (i, elem) {
		  var val = jQuery(this).val();

		  return val == null ?
				null :
				jQuery.isArray(val) ?
					jQuery.map(val, function (val, i) {
					  return { name: elem.name, value: val };
					}) :
					{ name: elem.name, value: val };
		}).get();
    }
  });

  // Attach a bunch of functions for handling common AJAX events
  jQuery.each("ajaxStart ajaxStop ajaxComplete ajaxError ajaxSuccess ajaxSend".split(" "), function (i, o) {
    jQuery.fn[o] = function (f) {
      return this.bind(o, f);
    };
  });

  jQuery.extend({
    get: function (url, data, callback, type) {
      // shift arguments if data argument was omited
      if (jQuery.isFunction(data)) {
        type = type || callback;
        callback = data;
        data = null;
      }

      return jQuery.ajax({
        type: "GET",
        url: url,
        data: data,
        success: callback,
        dataType: type
      });
    },

    getScript: function (url, callback) {
      return jQuery.get(url, null, callback, "script");
    },

    getJSON: function (url, data, callback) {
      return jQuery.get(url, data, callback, "json");
    },

    post: function (url, data, callback, type) {
      // shift arguments if data argument was omited
      if (jQuery.isFunction(data)) {
        type = type || callback;
        callback = data;
        data = {};
      }

      return jQuery.ajax({
        type: "POST",
        url: url,
        data: data,
        success: callback,
        dataType: type
      });
    },

    ajaxSetup: function (settings) {
      jQuery.extend(jQuery.ajaxSettings, settings);
    },

    ajaxSettings: {
      url: location.href,
      global: true,
      type: "GET",
      contentType: "application/x-www-form-urlencoded",
      processData: true,
      async: true,
      /*
      timeout: 0,
      data: null,
      username: null,
      password: null,
      traditional: false,
      */
      // This function can be overriden by calling jQuery.ajaxSetup
      xhr: function () {
        return new window.XMLHttpRequest();
      },
      accepts: {
        xml: "application/xml, text/xml",
        html: "text/html",
        script: "text/javascript, application/javascript",
        json: "application/json, text/javascript",
        text: "text/plain",
        _default: "*/*"
      }
    },

    ajax: function (origSettings) {
      var s = jQuery.extend(true, {}, jQuery.ajaxSettings, origSettings),
			jsonp, status, data, type = s.type.toUpperCase(), noContent = rnoContent.test(type);

      s.url = s.url.replace(rhash, "");

      // Use original (not extended) context object if it was provided
      s.context = origSettings && origSettings.context != null ? origSettings.context : s;

      // convert data if not already a string
      if (s.data && s.processData && typeof s.data !== "string") {
        s.data = jQuery.param(s.data, s.traditional);
      }

      // Handle JSONP Parameter Callbacks
      if (s.dataType === "jsonp") {
        if (type === "GET") {
          if (!jsre.test(s.url)) {
            s.url += (rquery.test(s.url) ? "&" : "?") + (s.jsonp || "callback") + "=?";
          }
        } else if (!s.data || !jsre.test(s.data)) {
          s.data = (s.data ? s.data + "&" : "") + (s.jsonp || "callback") + "=?";
        }
        s.dataType = "json";
      }

      // Build temporary JSONP function
      if (s.dataType === "json" && (s.data && jsre.test(s.data) || jsre.test(s.url))) {
        jsonp = s.jsonpCallback || ("jsonp" + jsc++);

        // Replace the =? sequence both in the query string and the data
        if (s.data) {
          s.data = (s.data + "").replace(jsre, "=" + jsonp + "$1");
        }

        s.url = s.url.replace(jsre, "=" + jsonp + "$1");

        // We need to make sure
        // that a JSONP style response is executed properly
        s.dataType = "script";

        // Handle JSONP-style loading
        var customJsonp = window[jsonp];

        window[jsonp] = function (tmp) {
          if (jQuery.isFunction(customJsonp)) {
            customJsonp(tmp);

          } else {
            // Garbage collect
            window[jsonp] = undefined;

            try {
              delete window[jsonp];
            } catch (jsonpError) { }
          }

          data = tmp;
          jQuery.handleSuccess(s, xhr, status, data);
          jQuery.handleComplete(s, xhr, status, data);

          if (head) {
            head.removeChild(script);
          }
        };
      }

      if (s.dataType === "script" && s.cache === null) {
        s.cache = false;
      }

      if (s.cache === false && noContent) {
        var ts = jQuery.now();

        // try replacing _= if it is there
        var ret = s.url.replace(rts, "$1_=" + ts);

        // if nothing was replaced, add timestamp to the end
        s.url = ret + ((ret === s.url) ? (rquery.test(s.url) ? "&" : "?") + "_=" + ts : "");
      }

      // If data is available, append data to url for GET/HEAD requests
      if (s.data && noContent) {
        s.url += (rquery.test(s.url) ? "&" : "?") + s.data;
      }

      // Watch for a new set of requests
      if (s.global && jQuery.active++ === 0) {
        jQuery.event.trigger("ajaxStart");
      }

      // Matches an absolute URL, and saves the domain
      var parts = rurl.exec(s.url),
			remote = parts && (parts[1] && parts[1].toLowerCase() !== location.protocol || parts[2].toLowerCase() !== location.host);

      // If we're requesting a remote document
      // and trying to load JSON or Script with a GET
      if (s.dataType === "script" && type === "GET" && remote) {
        var head = document.getElementsByTagName("head")[0] || document.documentElement;
        var script = document.createElement("script");
        if (s.scriptCharset) {
          script.charset = s.scriptCharset;
        }
        script.src = s.url;

        // Handle Script loading
        if (!jsonp) {
          var done = false;

          // Attach handlers for all browsers
          script.onload = script.onreadystatechange = function () {
            if (!done && (!this.readyState ||
							this.readyState === "loaded" || this.readyState === "complete")) {
              done = true;
              jQuery.handleSuccess(s, xhr, status, data);
              jQuery.handleComplete(s, xhr, status, data);

              // Handle memory leak in IE
              script.onload = script.onreadystatechange = null;
              if (head && script.parentNode) {
                head.removeChild(script);
              }
            }
          };
        }

        // Use insertBefore instead of appendChild  to circumvent an IE6 bug.
        // This arises when a base node is used (#2709 and #4378).
        head.insertBefore(script, head.firstChild);

        // We handle everything using the script element injection
        return undefined;
      }

      var requestDone = false;

      // Create the request object
      var xhr = s.xhr();

      if (!xhr) {
        return;
      }

      // Open the socket
      // Passing null username, generates a login popup on Opera (#2865)
      if (s.username) {
        xhr.open(type, s.url, s.async, s.username, s.password);
      } else {
        xhr.open(type, s.url, s.async);
      }

      // Need an extra try/catch for cross domain requests in Firefox 3
      try {
        // Set content-type if data specified and content-body is valid for this type
        if ((s.data != null && !noContent) || (origSettings && origSettings.contentType)) {
          xhr.setRequestHeader("Content-Type", s.contentType);
        }

        // Set the If-Modified-Since and/or If-None-Match header, if in ifModified mode.
        if (s.ifModified) {
          if (jQuery.lastModified[s.url]) {
            xhr.setRequestHeader("If-Modified-Since", jQuery.lastModified[s.url]);
          }

          if (jQuery.etag[s.url]) {
            xhr.setRequestHeader("If-None-Match", jQuery.etag[s.url]);
          }
        }

        // Set header so the called script knows that it's an XMLHttpRequest
        // Only send the header if it's not a remote XHR
        if (!remote) {
          xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
        }

        // Set the Accepts header for the server, depending on the dataType
        xhr.setRequestHeader("Accept", s.dataType && s.accepts[s.dataType] ?
				s.accepts[s.dataType] + ", */*; q=0.01" :
				s.accepts._default);
      } catch (headerError) { }

      // Allow custom headers/mimetypes and early abort
      if (s.beforeSend && s.beforeSend.call(s.context, xhr, s) === false) {
        // Handle the global AJAX counter
        if (s.global && jQuery.active-- === 1) {
          jQuery.event.trigger("ajaxStop");
        }

        // close opended socket
        xhr.abort();
        return false;
      }

      if (s.global) {
        jQuery.triggerGlobal(s, "ajaxSend", [xhr, s]);
      }

      // Wait for a response to come back
      var onreadystatechange = xhr.onreadystatechange = function (isTimeout) {
        // The request was aborted
        if (!xhr || xhr.readyState === 0 || isTimeout === "abort") {
          // Opera doesn't call onreadystatechange before this point
          // so we simulate the call
          if (!requestDone) {
            jQuery.handleComplete(s, xhr, status, data);
          }

          requestDone = true;
          if (xhr) {
            xhr.onreadystatechange = jQuery.noop;
          }

          // The transfer is complete and the data is available, or the request timed out
        } else if (!requestDone && xhr && (xhr.readyState === 4 || isTimeout === "timeout")) {
          requestDone = true;
          xhr.onreadystatechange = jQuery.noop;

          status = isTimeout === "timeout" ?
					"timeout" :
					!jQuery.httpSuccess(xhr) ?
						"error" :
						s.ifModified && jQuery.httpNotModified(xhr, s.url) ?
							"notmodified" :
							"success";

          var errMsg;

          if (status === "success") {
            // Watch for, and catch, XML document parse errors
            try {
              // process the data (runs the xml through httpData regardless of callback)
              data = jQuery.httpData(xhr, s.dataType, s);
            } catch (parserError) {
              status = "parsererror";
              errMsg = parserError;
            }
          }

          // Make sure that the request was successful or notmodified
          if (status === "success" || status === "notmodified") {
            // JSONP handles its own success callback
            if (!jsonp) {
              jQuery.handleSuccess(s, xhr, status, data);
            }
          } else {
            jQuery.handleError(s, xhr, status, errMsg);
          }

          // Fire the complete handlers
          if (!jsonp) {
            jQuery.handleComplete(s, xhr, status, data);
          }

          if (isTimeout === "timeout") {
            xhr.abort();
          }

          // Stop memory leaks
          if (s.async) {
            xhr = null;
          }
        }
      };

      // Override the abort handler, if we can (IE 6 doesn't allow it, but that's OK)
      // Opera doesn't fire onreadystatechange at all on abort
      try {
        var oldAbort = xhr.abort;
        xhr.abort = function () {
          if (xhr) {
            // oldAbort has no call property in IE7 so
            // just do it this way, which works in all
            // browsers
            Function.prototype.call.call(oldAbort, xhr);
          }

          onreadystatechange("abort");
        };
      } catch (abortError) { }

      // Timeout checker
      if (s.async && s.timeout > 0) {
        setTimeout(function () {
          // Check to see if the request is still happening
          if (xhr && !requestDone) {
            onreadystatechange("timeout");
          }
        }, s.timeout);
      }

      // Send the data
      try {
        xhr.send(noContent || s.data == null ? null : s.data);

      } catch (sendError) {
        jQuery.handleError(s, xhr, null, sendError);

        // Fire the complete handlers
        jQuery.handleComplete(s, xhr, status, data);
      }

      // firefox 1.5 doesn't fire statechange for sync requests
      if (!s.async) {
        onreadystatechange();
      }

      // return XMLHttpRequest to allow aborting the request etc.
      return xhr;
    },

    // Serialize an array of form elements or a set of
    // key/values into a query string
    param: function (a, traditional) {
      var s = [],
			add = function (key, value) {
			  // If value is a function, invoke it and return its value
			  value = jQuery.isFunction(value) ? value() : value;
			  s[s.length] = encodeURIComponent(key) + "=" + encodeURIComponent(value);
			};

      // Set traditional to true for jQuery <= 1.3.2 behavior.
      if (traditional === undefined) {
        traditional = jQuery.ajaxSettings.traditional;
      }

      // If an array was passed in, assume that it is an array of form elements.
      if (jQuery.isArray(a) || a.jquery) {
        // Serialize the form elements
        jQuery.each(a, function () {
          add(this.name, this.value);
        });

      } else {
        // If traditional, encode the "old" way (the way 1.3.2 or older
        // did it), otherwise encode params recursively.
        for (var prefix in a) {
          buildParams(prefix, a[prefix], traditional, add);
        }
      }

      // Return the resulting serialization
      return s.join("&").replace(r20, "+");
    }
  });

  function buildParams(prefix, obj, traditional, add) {
    if (jQuery.isArray(obj) && obj.length) {
      // Serialize array item.
      jQuery.each(obj, function (i, v) {
        if (traditional || rbracket.test(prefix)) {
          // Treat each array item as a scalar.
          add(prefix, v);

        } else {
          // If array item is non-scalar (array or object), encode its
          // numeric index to resolve deserialization ambiguity issues.
          // Note that rack (as of 1.0.0) can't currently deserialize
          // nested arrays properly, and attempting to do so may cause
          // a server error. Possible fixes are to modify rack's
          // deserialization algorithm or to provide an option or flag
          // to force array serialization to be shallow.
          buildParams(prefix + "[" + (typeof v === "object" || jQuery.isArray(v) ? i : "") + "]", v, traditional, add);
        }
      });

    } else if (!traditional && obj != null && typeof obj === "object") {
      if (jQuery.isEmptyObject(obj)) {
        add(prefix, "");

        // Serialize object item.
      } else {
        jQuery.each(obj, function (k, v) {
          buildParams(prefix + "[" + k + "]", v, traditional, add);
        });
      }

    } else {
      // Serialize scalar item.
      add(prefix, obj);
    }
  }

  // This is still on the jQuery object... for now
  // Want to move this to jQuery.ajax some day
  jQuery.extend({

    // Counter for holding the number of active queries
    active: 0,

    // Last-Modified header cache for next request
    lastModified: {},
    etag: {},

    handleError: function (s, xhr, status, e) {
      // If a local callback was specified, fire it
      if (s.error) {
        s.error.call(s.context, xhr, status, e);
      }

      // Fire the global callback
      if (s.global) {
        jQuery.triggerGlobal(s, "ajaxError", [xhr, s, e]);
      }
    },

    handleSuccess: function (s, xhr, status, data) {
      // If a local callback was specified, fire it and pass it the data
      if (s.success) {
        s.success.call(s.context, data, status, xhr);
      }

      // Fire the global callback
      if (s.global) {
        jQuery.triggerGlobal(s, "ajaxSuccess", [xhr, s]);
      }
    },

    handleComplete: function (s, xhr, status) {
      // Process result
      if (s.complete) {
        s.complete.call(s.context, xhr, status);
      }

      // The request was completed
      if (s.global) {
        jQuery.triggerGlobal(s, "ajaxComplete", [xhr, s]);
      }

      // Handle the global AJAX counter
      if (s.global && jQuery.active-- === 1) {
        jQuery.event.trigger("ajaxStop");
      }
    },

    triggerGlobal: function (s, type, args) {
      (s.context && s.context.url == null ? jQuery(s.context) : jQuery.event).trigger(type, args);
    },

    // Determines if an XMLHttpRequest was successful or not
    httpSuccess: function (xhr) {
      try {
        // IE error sometimes returns 1223 when it should be 204 so treat it as success, see #1450
        return !xhr.status && location.protocol === "file:" ||
				xhr.status >= 200 && xhr.status < 300 ||
				xhr.status === 304 || xhr.status === 1223;
      } catch (e) { }

      return false;
    },

    // Determines if an XMLHttpRequest returns NotModified
    httpNotModified: function (xhr, url) {
      var lastModified = xhr.getResponseHeader("Last-Modified"),
			etag = xhr.getResponseHeader("Etag");

      if (lastModified) {
        jQuery.lastModified[url] = lastModified;
      }

      if (etag) {
        jQuery.etag[url] = etag;
      }

      return xhr.status === 304;
    },

    httpData: function (xhr, type, s) {
      var ct = xhr.getResponseHeader("content-type") || "",
			xml = type === "xml" || !type && ct.indexOf("xml") >= 0,
			data = xml ? xhr.responseXML : xhr.responseText;

      if (xml && data.documentElement.nodeName === "parsererror") {
        jQuery.error("parsererror");
      }

      // Allow a pre-filtering function to sanitize the response
      // s is checked to keep backwards compatibility
      if (s && s.dataFilter) {
        data = s.dataFilter(data, type);
      }

      // The filter can actually parse the response
      if (typeof data === "string") {
        // Get the JavaScript object, if JSON is used.
        if (type === "json" || !type && ct.indexOf("json") >= 0) {
          data = jQuery.parseJSON(data);

          // If the type is "script", eval it in global context
        } else if (type === "script" || !type && ct.indexOf("javascript") >= 0) {
          jQuery.globalEval(data);
        }
      }

      return data;
    }

  });

  /*
  * Create the request object; Microsoft failed to properly
  * implement the XMLHttpRequest in IE7 (can't request local files),
  * so we use the ActiveXObject when it is available
  * Additionally XMLHttpRequest can be disabled in IE7/IE8 so
  * we need a fallback.
  */
  if (window.ActiveXObject) {
    jQuery.ajaxSettings.xhr = function () {
      if (window.location.protocol !== "file:") {
        try {
          return new window.XMLHttpRequest();
        } catch (xhrError) { }
      }

      try {
        return new window.ActiveXObject("Microsoft.XMLHTTP");
      } catch (activeError) { }
    };
  }

  // Does this browser support XHR requests?
  jQuery.support.ajax = !!jQuery.ajaxSettings.xhr();




  var elemdisplay = {},
	rfxtypes = /^(?:toggle|show|hide)$/,
	rfxnum = /^([+\-]=)?([\d+.\-]+)(.*)$/,
	timerId,
	fxAttrs = [
  // height animations
		["height", "marginTop", "marginBottom", "paddingTop", "paddingBottom"],
  // width animations
		["width", "marginLeft", "marginRight", "paddingLeft", "paddingRight"],
  // opacity animations
		["opacity"]
	];

  jQuery.fn.extend({
    show: function (speed, easing, callback) {
      var elem, display;

      if (speed || speed === 0) {
        return this.animate(genFx("show", 3), speed, easing, callback);

      } else {
        for (var i = 0, j = this.length; i < j; i++) {
          elem = this[i];
          display = elem.style.display;

          // Reset the inline display of this element to learn if it is
          // being hidden by cascaded rules or not
          if (!jQuery.data(elem, "olddisplay") && display === "none") {
            display = elem.style.display = "";
          }

          // Set elements which have been overridden with display: none
          // in a stylesheet to whatever the default browser style is
          // for such an element
          if (display === "" && jQuery.css(elem, "display") === "none") {
            jQuery.data(elem, "olddisplay", defaultDisplay(elem.nodeName));
          }
        }

        // Set the display of most of the elements in a second loop
        // to avoid the constant reflow
        for (i = 0; i < j; i++) {
          elem = this[i];
          display = elem.style.display;

          if (display === "" || display === "none") {
            elem.style.display = jQuery.data(elem, "olddisplay") || "";
          }
        }

        return this;
      }
    },

    hide: function (speed, easing, callback) {
      if (speed || speed === 0) {
        return this.animate(genFx("hide", 3), speed, easing, callback);

      } else {
        for (var i = 0, j = this.length; i < j; i++) {
          var display = jQuery.css(this[i], "display");

          if (display !== "none") {
            jQuery.data(this[i], "olddisplay", display);
          }
        }

        // Set the display of the elements in a second loop
        // to avoid the constant reflow
        for (i = 0; i < j; i++) {
          this[i].style.display = "none";
        }

        return this;
      }
    },

    // Save the old toggle function
    _toggle: jQuery.fn.toggle,

    toggle: function (fn, fn2, callback) {
      var bool = typeof fn === "boolean";

      if (jQuery.isFunction(fn) && jQuery.isFunction(fn2)) {
        this._toggle.apply(this, arguments);

      } else if (fn == null || bool) {
        this.each(function () {
          var state = bool ? fn : jQuery(this).is(":hidden");
          jQuery(this)[state ? "show" : "hide"]();
        });

      } else {
        this.animate(genFx("toggle", 3), fn, fn2, callback);
      }

      return this;
    },

    fadeTo: function (speed, to, easing, callback) {
      return this.filter(":hidden").css("opacity", 0).show().end()
					.animate({ opacity: to }, speed, easing, callback);
    },

    animate: function (prop, speed, easing, callback) {
      var optall = jQuery.speed(speed, easing, callback);

      if (jQuery.isEmptyObject(prop)) {
        return this.each(optall.complete);
      }

      return this[optall.queue === false ? "each" : "queue"](function () {
        // XXX 'this' does not always have a nodeName when running the
        // test suite

        var opt = jQuery.extend({}, optall), p,
				isElement = this.nodeType === 1,
				hidden = isElement && jQuery(this).is(":hidden"),
				self = this;

        for (p in prop) {
          var name = jQuery.camelCase(p);

          if (p !== name) {
            prop[name] = prop[p];
            delete prop[p];
            p = name;
          }

          if (prop[p] === "hide" && hidden || prop[p] === "show" && !hidden) {
            return opt.complete.call(this);
          }

          if (isElement && (p === "height" || p === "width")) {
            // Make sure that nothing sneaks out
            // Record all 3 overflow attributes because IE does not
            // change the overflow attribute when overflowX and
            // overflowY are set to the same value
            opt.overflow = [this.style.overflow, this.style.overflowX, this.style.overflowY];

            // Set display property to inline-block for height/width
            // animations on inline elements that are having width/height
            // animated
            if (jQuery.css(this, "display") === "inline" &&
							jQuery.css(this, "float") === "none") {
              if (!jQuery.support.inlineBlockNeedsLayout) {
                this.style.display = "inline-block";

              } else {
                var display = defaultDisplay(this.nodeName);

                // inline-level elements accept inline-block;
                // block-level elements need to be inline with layout
                if (display === "inline") {
                  this.style.display = "inline-block";

                } else {
                  this.style.display = "inline";
                  this.style.zoom = 1;
                }
              }
            }
          }

          if (jQuery.isArray(prop[p])) {
            // Create (if needed) and add to specialEasing
            (opt.specialEasing = opt.specialEasing || {})[p] = prop[p][1];
            prop[p] = prop[p][0];
          }
        }

        if (opt.overflow != null) {
          this.style.overflow = "hidden";
        }

        opt.curAnim = jQuery.extend({}, prop);

        jQuery.each(prop, function (name, val) {
          var e = new jQuery.fx(self, opt, name);

          if (rfxtypes.test(val)) {
            e[val === "toggle" ? hidden ? "show" : "hide" : val](prop);

          } else {
            var parts = rfxnum.exec(val),
						start = e.cur() || 0;

            if (parts) {
              var end = parseFloat(parts[2]),
							unit = parts[3] || "px";

              // We need to compute starting value
              if (unit !== "px") {
                jQuery.style(self, name, (end || 1) + unit);
                start = ((end || 1) / e.cur()) * start;
                jQuery.style(self, name, start + unit);
              }

              // If a +=/-= token was provided, we're doing a relative animation
              if (parts[1]) {
                end = ((parts[1] === "-=" ? -1 : 1) * end) + start;
              }

              e.custom(start, end, unit);

            } else {
              e.custom(start, val, "");
            }
          }
        });

        // For JS strict compliance
        return true;
      });
    },

    stop: function (clearQueue, gotoEnd) {
      var timers = jQuery.timers;

      if (clearQueue) {
        this.queue([]);
      }

      this.each(function () {
        // go in reverse order so anything added to the queue during the loop is ignored
        for (var i = timers.length - 1; i >= 0; i--) {
          if (timers[i].elem === this) {
            if (gotoEnd) {
              // force the next step to be the last
              timers[i](true);
            }

            timers.splice(i, 1);
          }
        }
      });

      // start the next in the queue if the last step wasn't forced
      if (!gotoEnd) {
        this.dequeue();
      }

      return this;
    }

  });

  function genFx(type, num) {
    var obj = {};

    jQuery.each(fxAttrs.concat.apply([], fxAttrs.slice(0, num)), function () {
      obj[this] = type;
    });

    return obj;
  }

  // Generate shortcuts for custom animations
  jQuery.each({
    slideDown: genFx("show", 1),
    slideUp: genFx("hide", 1),
    slideToggle: genFx("toggle", 1),
    fadeIn: { opacity: "show" },
    fadeOut: { opacity: "hide" },
    fadeToggle: { opacity: "toggle" }
  }, function (name, props) {
    jQuery.fn[name] = function (speed, easing, callback) {
      return this.animate(props, speed, easing, callback);
    };
  });

  jQuery.extend({
    speed: function (speed, easing, fn) {
      var opt = speed && typeof speed === "object" ? jQuery.extend({}, speed) : {
        complete: fn || !fn && easing ||
				jQuery.isFunction(speed) && speed,
        duration: speed,
        easing: fn && easing || easing && !jQuery.isFunction(easing) && easing
      };

      opt.duration = jQuery.fx.off ? 0 : typeof opt.duration === "number" ? opt.duration :
			opt.duration in jQuery.fx.speeds ? jQuery.fx.speeds[opt.duration] : jQuery.fx.speeds._default;

      // Queueing
      opt.old = opt.complete;
      opt.complete = function () {
        if (opt.queue !== false) {
          jQuery(this).dequeue();
        }
        if (jQuery.isFunction(opt.old)) {
          opt.old.call(this);
        }
      };

      return opt;
    },

    easing: {
      linear: function (p, n, firstNum, diff) {
        return firstNum + diff * p;
      },
      swing: function (p, n, firstNum, diff) {
        return ((-Math.cos(p * Math.PI) / 2) + 0.5) * diff + firstNum;
      }
    },

    timers: [],

    fx: function (elem, options, prop) {
      this.options = options;
      this.elem = elem;
      this.prop = prop;

      if (!options.orig) {
        options.orig = {};
      }
    }

  });

  jQuery.fx.prototype = {
    // Simple function for setting a style value
    update: function () {
      if (this.options.step) {
        this.options.step.call(this.elem, this.now, this);
      }

      (jQuery.fx.step[this.prop] || jQuery.fx.step._default)(this);
    },

    // Get the current size
    cur: function () {
      if (this.elem[this.prop] != null && (!this.elem.style || this.elem.style[this.prop] == null)) {
        return this.elem[this.prop];
      }

      var r = parseFloat(jQuery.css(this.elem, this.prop));
      return r && r > -10000 ? r : 0;
    },

    // Start an animation from one number to another
    custom: function (from, to, unit) {
      var self = this,
			fx = jQuery.fx;

      this.startTime = jQuery.now();
      this.start = from;
      this.end = to;
      this.unit = unit || this.unit || "px";
      this.now = this.start;
      this.pos = this.state = 0;

      function t(gotoEnd) {
        return self.step(gotoEnd);
      }

      t.elem = this.elem;

      if (t() && jQuery.timers.push(t) && !timerId) {
        timerId = setInterval(fx.tick, fx.interval);
      }
    },

    // Simple 'show' function
    show: function () {
      // Remember where we started, so that we can go back to it later
      this.options.orig[this.prop] = jQuery.style(this.elem, this.prop);
      this.options.show = true;

      // Begin the animation
      // Make sure that we start at a small width/height to avoid any
      // flash of content
      this.custom(this.prop === "width" || this.prop === "height" ? 1 : 0, this.cur());

      // Start by showing the element
      jQuery(this.elem).show();
    },

    // Simple 'hide' function
    hide: function () {
      // Remember where we started, so that we can go back to it later
      this.options.orig[this.prop] = jQuery.style(this.elem, this.prop);
      this.options.hide = true;

      // Begin the animation
      this.custom(this.cur(), 0);
    },

    // Each step of an animation
    step: function (gotoEnd) {
      var t = jQuery.now(), done = true;

      if (gotoEnd || t >= this.options.duration + this.startTime) {
        this.now = this.end;
        this.pos = this.state = 1;
        this.update();

        this.options.curAnim[this.prop] = true;

        for (var i in this.options.curAnim) {
          if (this.options.curAnim[i] !== true) {
            done = false;
          }
        }

        if (done) {
          // Reset the overflow
          if (this.options.overflow != null && !jQuery.support.shrinkWrapBlocks) {
            var elem = this.elem,
						options = this.options;

            jQuery.each(["", "X", "Y"], function (index, value) {
              elem.style["overflow" + value] = options.overflow[index];
            });
          }

          // Hide the element if the "hide" operation was done
          if (this.options.hide) {
            jQuery(this.elem).hide();
          }

          // Reset the properties, if the item has been hidden or shown
          if (this.options.hide || this.options.show) {
            for (var p in this.options.curAnim) {
              jQuery.style(this.elem, p, this.options.orig[p]);
            }
          }

          // Execute the complete function
          this.options.complete.call(this.elem);
        }

        return false;

      } else {
        var n = t - this.startTime;
        this.state = n / this.options.duration;

        // Perform the easing function, defaults to swing
        var specialEasing = this.options.specialEasing && this.options.specialEasing[this.prop];
        var defaultEasing = this.options.easing || (jQuery.easing.swing ? "swing" : "linear");
        this.pos = jQuery.easing[specialEasing || defaultEasing](this.state, n, 0, 1, this.options.duration);
        this.now = this.start + ((this.end - this.start) * this.pos);

        // Perform the next step of the animation
        this.update();
      }

      return true;
    }
  };

  jQuery.extend(jQuery.fx, {
    tick: function () {
      var timers = jQuery.timers;

      for (var i = 0; i < timers.length; i++) {
        if (!timers[i]()) {
          timers.splice(i--, 1);
        }
      }

      if (!timers.length) {
        jQuery.fx.stop();
      }
    },

    interval: 13,

    stop: function () {
      clearInterval(timerId);
      timerId = null;
    },

    speeds: {
      slow: 600,
      fast: 200,
      // Default speed
      _default: 400
    },

    step: {
      opacity: function (fx) {
        jQuery.style(fx.elem, "opacity", fx.now);
      },

      _default: function (fx) {
        if (fx.elem.style && fx.elem.style[fx.prop] != null) {
          fx.elem.style[fx.prop] = (fx.prop === "width" || fx.prop === "height" ? Math.max(0, fx.now) : fx.now) + fx.unit;
        } else {
          fx.elem[fx.prop] = fx.now;
        }
      }
    }
  });

  if (jQuery.expr && jQuery.expr.filters) {
    jQuery.expr.filters.animated = function (elem) {
      return jQuery.grep(jQuery.timers, function (fn) {
        return elem === fn.elem;
      }).length;
    };
  }

  function defaultDisplay(nodeName) {
    if (!elemdisplay[nodeName]) {
      var elem = jQuery("<" + nodeName + ">").appendTo("body"),
			display = elem.css("display");

      elem.remove();

      if (display === "none" || display === "") {
        display = "block";
      }

      elemdisplay[nodeName] = display;
    }

    return elemdisplay[nodeName];
  }




  var rtable = /^t(?:able|d|h)$/i,
	rroot = /^(?:body|html)$/i;

  if ("getBoundingClientRect" in document.documentElement) {
    jQuery.fn.offset = function (options) {
      var elem = this[0], box;

      if (options) {
        return this.each(function (i) {
          jQuery.offset.setOffset(this, options, i);
        });
      }

      if (!elem || !elem.ownerDocument) {
        return null;
      }

      if (elem === elem.ownerDocument.body) {
        return jQuery.offset.bodyOffset(elem);
      }

      try {
        box = elem.getBoundingClientRect();
      } catch (e) { }

      var doc = elem.ownerDocument,
			docElem = doc.documentElement;

      // Make sure we're not dealing with a disconnected DOM node
      if (!box || !jQuery.contains(docElem, elem)) {
        return box || { top: 0, left: 0 };
      }

      var body = doc.body,
			win = getWindow(doc),
			clientTop = docElem.clientTop || body.clientTop || 0,
			clientLeft = docElem.clientLeft || body.clientLeft || 0,
			scrollTop = (win.pageYOffset || jQuery.support.boxModel && docElem.scrollTop || body.scrollTop),
			scrollLeft = (win.pageXOffset || jQuery.support.boxModel && docElem.scrollLeft || body.scrollLeft),
			top = box.top + scrollTop - clientTop,
			left = box.left + scrollLeft - clientLeft;

      return { top: top, left: left };
    };

  } else {
    jQuery.fn.offset = function (options) {
      var elem = this[0];

      if (options) {
        return this.each(function (i) {
          jQuery.offset.setOffset(this, options, i);
        });
      }

      if (!elem || !elem.ownerDocument) {
        return null;
      }

      if (elem === elem.ownerDocument.body) {
        return jQuery.offset.bodyOffset(elem);
      }

      jQuery.offset.initialize();

      var computedStyle,
			offsetParent = elem.offsetParent,
			prevOffsetParent = elem,
			doc = elem.ownerDocument,
			docElem = doc.documentElement,
			body = doc.body,
			defaultView = doc.defaultView,
			prevComputedStyle = defaultView ? defaultView.getComputedStyle(elem, null) : elem.currentStyle,
			top = elem.offsetTop,
			left = elem.offsetLeft;

      while ((elem = elem.parentNode) && elem !== body && elem !== docElem) {
        if (jQuery.offset.supportsFixedPosition && prevComputedStyle.position === "fixed") {
          break;
        }

        computedStyle = defaultView ? defaultView.getComputedStyle(elem, null) : elem.currentStyle;
        top -= elem.scrollTop;
        left -= elem.scrollLeft;

        if (elem === offsetParent) {
          top += elem.offsetTop;
          left += elem.offsetLeft;

          if (jQuery.offset.doesNotAddBorder && !(jQuery.offset.doesAddBorderForTableAndCells && rtable.test(elem.nodeName))) {
            top += parseFloat(computedStyle.borderTopWidth) || 0;
            left += parseFloat(computedStyle.borderLeftWidth) || 0;
          }

          prevOffsetParent = offsetParent;
          offsetParent = elem.offsetParent;
        }

        if (jQuery.offset.subtractsBorderForOverflowNotVisible && computedStyle.overflow !== "visible") {
          top += parseFloat(computedStyle.borderTopWidth) || 0;
          left += parseFloat(computedStyle.borderLeftWidth) || 0;
        }

        prevComputedStyle = computedStyle;
      }

      if (prevComputedStyle.position === "relative" || prevComputedStyle.position === "static") {
        top += body.offsetTop;
        left += body.offsetLeft;
      }

      if (jQuery.offset.supportsFixedPosition && prevComputedStyle.position === "fixed") {
        top += Math.max(docElem.scrollTop, body.scrollTop);
        left += Math.max(docElem.scrollLeft, body.scrollLeft);
      }

      return { top: top, left: left };
    };
  }

  jQuery.offset = {
    initialize: function () {
      var body = document.body, container = document.createElement("div"), innerDiv, checkDiv, table, td, bodyMarginTop = parseFloat(jQuery.css(body, "marginTop")) || 0,
			html = "<div style='position:absolute;top:0;left:0;margin:0;border:5px solid #000;padding:0;width:1px;height:1px;'><div></div></div><table style='position:absolute;top:0;left:0;margin:0;border:5px solid #000;padding:0;width:1px;height:1px;' cellpadding='0' cellspacing='0'><tr><td></td></tr></table>";

      jQuery.extend(container.style, { position: "absolute", top: 0, left: 0, margin: 0, border: 0, width: "1px", height: "1px", visibility: "hidden" });

      container.innerHTML = html;
      body.insertBefore(container, body.firstChild);
      innerDiv = container.firstChild;
      checkDiv = innerDiv.firstChild;
      td = innerDiv.nextSibling.firstChild.firstChild;

      this.doesNotAddBorder = (checkDiv.offsetTop !== 5);
      this.doesAddBorderForTableAndCells = (td.offsetTop === 5);

      checkDiv.style.position = "fixed";
      checkDiv.style.top = "20px";

      // safari subtracts parent border width here which is 5px
      this.supportsFixedPosition = (checkDiv.offsetTop === 20 || checkDiv.offsetTop === 15);
      checkDiv.style.position = checkDiv.style.top = "";

      innerDiv.style.overflow = "hidden";
      innerDiv.style.position = "relative";

      this.subtractsBorderForOverflowNotVisible = (checkDiv.offsetTop === -5);

      this.doesNotIncludeMarginInBodyOffset = (body.offsetTop !== bodyMarginTop);

      body.removeChild(container);
      body = container = innerDiv = checkDiv = table = td = null;
      jQuery.offset.initialize = jQuery.noop;
    },

    bodyOffset: function (body) {
      var top = body.offsetTop,
			left = body.offsetLeft;

      jQuery.offset.initialize();

      if (jQuery.offset.doesNotIncludeMarginInBodyOffset) {
        top += parseFloat(jQuery.css(body, "marginTop")) || 0;
        left += parseFloat(jQuery.css(body, "marginLeft")) || 0;
      }

      return { top: top, left: left };
    },

    setOffset: function (elem, options, i) {
      var position = jQuery.css(elem, "position");

      // set position first, in-case top/left are set even on static elem
      if (position === "static") {
        elem.style.position = "relative";
      }

      var curElem = jQuery(elem),
			curOffset = curElem.offset(),
			curCSSTop = jQuery.css(elem, "top"),
			curCSSLeft = jQuery.css(elem, "left"),
			calculatePosition = (position === "absolute" && jQuery.inArray('auto', [curCSSTop, curCSSLeft]) > -1),
			props = {}, curPosition = {}, curTop, curLeft;

      // need to be able to calculate position if either top or left is auto and position is absolute
      if (calculatePosition) {
        curPosition = curElem.position();
      }

      curTop = calculatePosition ? curPosition.top : parseInt(curCSSTop, 10) || 0;
      curLeft = calculatePosition ? curPosition.left : parseInt(curCSSLeft, 10) || 0;

      if (jQuery.isFunction(options)) {
        options = options.call(elem, i, curOffset);
      }

      if (options.top != null) {
        props.top = (options.top - curOffset.top) + curTop;
      }
      if (options.left != null) {
        props.left = (options.left - curOffset.left) + curLeft;
      }

      if ("using" in options) {
        options.using.call(elem, props);
      } else {
        curElem.css(props);
      }
    }
  };


  jQuery.fn.extend({
    position: function () {
      if (!this[0]) {
        return null;
      }

      var elem = this[0],

      // Get *real* offsetParent
		offsetParent = this.offsetParent(),

      // Get correct offsets
		offset = this.offset(),
		parentOffset = rroot.test(offsetParent[0].nodeName) ? { top: 0, left: 0} : offsetParent.offset();

      // Subtract element margins
      // note: when an element has margin: auto the offsetLeft and marginLeft
      // are the same in Safari causing offset.left to incorrectly be 0
      offset.top -= parseFloat(jQuery.css(elem, "marginTop")) || 0;
      offset.left -= parseFloat(jQuery.css(elem, "marginLeft")) || 0;

      // Add offsetParent borders
      parentOffset.top += parseFloat(jQuery.css(offsetParent[0], "borderTopWidth")) || 0;
      parentOffset.left += parseFloat(jQuery.css(offsetParent[0], "borderLeftWidth")) || 0;

      // Subtract the two offsets
      return {
        top: offset.top - parentOffset.top,
        left: offset.left - parentOffset.left
      };
    },

    offsetParent: function () {
      return this.map(function () {
        var offsetParent = this.offsetParent || document.body;
        while (offsetParent && (!rroot.test(offsetParent.nodeName) && jQuery.css(offsetParent, "position") === "static")) {
          offsetParent = offsetParent.offsetParent;
        }
        return offsetParent;
      });
    }
  });


  // Create scrollLeft and scrollTop methods
  jQuery.each(["Left", "Top"], function (i, name) {
    var method = "scroll" + name;

    jQuery.fn[method] = function (val) {
      var elem = this[0], win;

      if (!elem) {
        return null;
      }

      if (val !== undefined) {
        // Set the scroll offset
        return this.each(function () {
          win = getWindow(this);

          if (win) {
            win.scrollTo(
						!i ? val : jQuery(win).scrollLeft(),
						 i ? val : jQuery(win).scrollTop()
					);

          } else {
            this[method] = val;
          }
        });
      } else {
        win = getWindow(elem);

        // Return the scroll offset
        return win ? ("pageXOffset" in win) ? win[i ? "pageYOffset" : "pageXOffset"] :
				jQuery.support.boxModel && win.document.documentElement[method] ||
					win.document.body[method] :
				elem[method];
      }
    };
  });

  function getWindow(elem) {
    return jQuery.isWindow(elem) ?
		elem :
		elem.nodeType === 9 ?
			elem.defaultView || elem.parentWindow :
			false;
  }




  // Create innerHeight, innerWidth, outerHeight and outerWidth methods
  jQuery.each(["Height", "Width"], function (i, name) {

    var type = name.toLowerCase();

    // innerHeight and innerWidth
    jQuery.fn["inner" + name] = function () {
      return this[0] ?
			parseFloat(jQuery.css(this[0], type, "padding")) :
			null;
    };

    // outerHeight and outerWidth
    jQuery.fn["outer" + name] = function (margin) {
      return this[0] ?
			parseFloat(jQuery.css(this[0], type, margin ? "margin" : "border")) :
			null;
    };

    jQuery.fn[type] = function (size) {
      // Get window width or height
      var elem = this[0];
      if (!elem) {
        return size == null ? null : this;
      }

      if (jQuery.isFunction(size)) {
        return this.each(function (i) {
          var self = jQuery(this);
          self[type](size.call(this, i, self[type]()));
        });
      }

      if (jQuery.isWindow(elem)) {
        // Everyone else use document.documentElement or document.body depending on Quirks vs Standards mode
        return elem.document.compatMode === "CSS1Compat" && elem.document.documentElement["client" + name] ||
				elem.document.body["client" + name];

        // Get document width or height
      } else if (elem.nodeType === 9) {
        // Either scroll[Width/Height] or offset[Width/Height], whichever is greater
        return Math.max(
				elem.documentElement["client" + name],
				elem.body["scroll" + name], elem.documentElement["scroll" + name],
				elem.body["offset" + name], elem.documentElement["offset" + name]
			);

        // Get or set width or height on the element
      } else if (size === undefined) {
        var orig = jQuery.css(elem, type),
				ret = parseFloat(orig);

        return jQuery.isNaN(ret) ? orig : ret;

        // Set the width or height on the element (default to pixels if value is unitless)
      } else {
        return this.css(type, typeof size === "string" ? size : size + "px");
      }
    };

  });


})(window);/*
 * jQuery Address Plugin v1.3.1
 * http://www.asual.com/jquery/address/
 *
 * Copyright (c) 2009-2010 Rostislav Hristov
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * Date: 2010-11-29 11:54:20 +0200 (Mon, 29 Nov 2010)
 */
(function(c){c.address=function(){var y=function(a){c(c.address).trigger(c.extend(c.Event(a),function(){for(var b={},e=c.address.parameterNames(),h=0,q=e.length;h<q;h++)b[e[h]]=c.address.parameter(e[h]);return{value:c.address.value(),path:c.address.path(),pathNames:c.address.pathNames(),parameterNames:e,parameters:b,queryString:c.address.queryString()}}.call(c.address)))},z=function(a,b,e){c(c.address).bind(a,b,e);return c.address},B=function(){return A.pushState&&d.state!==i},K=function(){return("/"+
g.pathname.replace(new RegExp(d.state),"")+g.search+(J()?"#"+J():"")).replace(ba,"/")},J=function(){var a=g.href.indexOf("#");return a!=-1?C(g.href.substr(a+1),l):""},v=function(){return B()?K():J()},ua=function(){return"javascript"},s=function(a){a=a.toString();return(d.strict&&a.substr(0,1)!="/"?"/":"")+a},C=function(a,b){if(d.crawlable&&b)return(a!=""?"!":"")+a;return a.replace(/^\!/,"")},D=function(a,b){return parseInt(a.css(b),10)},ca=function(a){for(var b,e,h=0,q=a.childNodes.length;h<q;h++){if(a.childNodes[h].src)b=
String(a.childNodes[h].src);if(e=ca(a.childNodes[h]))b=e}return b},O=function(){if(!T){var a=v(),b=f!=a;if(E&&p<523){if(L!=A.length){L=A.length;if(I[L-1]!==i)f=I[L-1];M(l)}}else if(b)if(F&&p<7)g.reload();else{F&&p<8&&d.history&&w(W,50);f=a;M(l)}}},M=function(a){y(da);y(a?ea:fa);w(ga,10)},ga=function(){if(d.tracker!=="null"&&d.tracker!==null){var a=c.isFunction(d.tracker)?d.tracker:k[d.tracker],b=(g.pathname+g.search+(c.address&&!B()?c.address.value():"")).replace(/\/\//,"/").replace(/^\/$/,"");if(c.isFunction(a))a(b);
else if(c.isFunction(k.urchinTracker))k.urchinTracker(b);else if(k.pageTracker!==i&&c.isFunction(k.pageTracker._trackPageview))k.pageTracker._trackPageview(b);else k._gaq!==i&&c.isFunction(k._gaq.push)&&k._gaq.push(["_trackPageview",b])}},W=function(){var a=ua()+":"+l+";document.open();document.writeln('<html><head><title>"+n.title.replace("'","\\'")+"</title><script>var "+r+' = "'+encodeURIComponent(v())+(n.domain!=g.host?'";document.domain="'+n.domain:"")+"\";<\/script></head></html>');document.close();";
if(p<7)o.src=a;else o.contentWindow.location.replace(a)},ia=function(){if(P&&ha!=-1){var a,b=P.substr(ha+1).split("&");for(u=0;u<b.length;u++){a=b[u].split("=");if(/^(autoUpdate|crawlable|history|strict|wrap)$/.test(a[0]))d[a[0]]=isNaN(a[1])?/^(true|yes)$/i.test(a[1]):parseInt(a[1],10)!==0;if(/^(state|tracker)$/.test(a[0]))d[a[0]]=a[1]}P=null}f=v()},ka=function(){if(!ja){ja=m;ia();var a=function(){va.call(this);wa.call(this)},b=c("body").ajaxComplete(a);a();if(d.wrap){c("body > *").wrapAll('<div style="padding:'+
(D(b,"marginTop")+D(b,"paddingTop"))+"px "+(D(b,"marginRight")+D(b,"paddingRight"))+"px "+(D(b,"marginBottom")+D(b,"paddingBottom"))+"px "+(D(b,"marginLeft")+D(b,"paddingLeft"))+'px;" />').parent().wrap('<div id="'+r+'" style="height:100%;overflow:auto;position:relative;'+(E?window.statusbar.visible&&!/chrome/i.test(X)?"":"resize:both;":"")+'" />');c("html, body").css({height:"100%",margin:0,padding:0,overflow:"hidden"});E&&c('<style type="text/css" />').appendTo("head").text("#"+r+"::-webkit-resizer { background-color: #fff; }")}if(F&&
p<8){a=n.getElementsByTagName("frameset")[0];o=n.createElement((a?"":"i")+"frame");if(a){a.insertAdjacentElement("beforeEnd",o);a[a.cols?"cols":"rows"]+=",0";o.noResize=m;o.frameBorder=o.frameSpacing=0}else{o.style.display="none";o.style.width=o.style.height=0;o.tabIndex=-1;n.body.insertAdjacentElement("afterBegin",o)}w(function(){c(o).bind("load",function(){var e=o.contentWindow;f=e[r]!==i?e[r]:"";if(f!=v()){M(l);g.hash=C(f,m)}});o.contentWindow[r]===i&&W()},50)}else if(E){if(p<418){c(n.body).append('<form id="'+
r+'" style="position:absolute;top:-9999px;" method="get"></form>');Y=n.getElementById(r)}if(g[r]===i)g[r]={};if(g[r][g.pathname]!==i)I=g[r][g.pathname].split(",")}w(function(){y("init");M(l)},1);if(!B())if(F&&p>7||!F&&"on"+Q in k)if(k.addEventListener)k.addEventListener(Q,O,l);else k.attachEvent&&k.attachEvent("on"+Q,O);else xa(O,50)}},va=function(){var a,b=c("a"),e=b.size(),h=-1;w(function(){if(++h!=e){a=c(b.get(h));a.is("[rel*=address:]")&&a.address();w(arguments.callee,1)}},1)},ya=function(){if(f!=
v()){f=v();M(l)}},za=function(){if(k.removeEventListener)k.removeEventListener(Q,O,l);else k.detachEvent&&k.detachEvent("on"+Q,O)},wa=function(){if(d.crawlable){var a=g.pathname.replace(/\/$/,"");c("body").html().indexOf("_escaped_fragment_")!=-1&&c("a[href]:not([href^=http]), , a[href*="+document.domain+"]").each(function(){var b=c(this).attr("href").replace(/^http:/,"").replace(new RegExp(a+"/?$"),"");if(b==""||b.indexOf("_escaped_fragment_")!=-1)c(this).attr("href","#"+c.address.decode(b.replace(/\/(.*)\?_escaped_fragment_=(.*)$/,
"!$2")))})}},G=function(a){return la(ma(a)).replace(/%20/g,"+")},na=function(a){return a.split("#")[0].split("?")[0]},oa=function(a){a=na(a);var b=a.replace(ba,"/").split("/");if(a.substr(0,1)=="/"||a.length===0)b.splice(0,1);a.substr(a.length-1,1)=="/"&&b.splice(b.length-1,1);return b},R=function(a){a=a.split("?");return a.slice(1,a.length).join("?").split("#")[0]},pa=function(a,b){if(b=R(b)){params=b.split("&");b=[];for(u=0;u<params.length;u++){var e=params[u].split("=");if(e[0]==a||c.address.decode(e[0])==
a)b.push(e.slice(1).join("="))}if(b.length!==0)return b.length!=1?b:b[0]}},qa=function(a){var b=R(a);a=[];if(b&&b.indexOf("=")!=-1){b=b.split("&");for(var e=0;e<b.length;e++){var h=b[e].split("=")[0];c.inArray(h,a)==-1&&a.push(h)}}return a},U=function(a){a=a.split("#");return a.slice(1,a.length).join("#")},i,r="jQueryAddress",Q="hashchange",da="change",ea="internalChange",fa="externalChange",m=true,l=false,d={autoUpdate:m,crawlable:l,history:m,strict:m,wrap:l},t=c.browser,p=parseFloat(c.browser.version),
ra=t.mozilla,F=t.msie,sa=t.opera,E=t.webkit||t.safari,Z=l,k=function(){try{return top.document!==i?top:window}catch(a){return window}}(),n=k.document,A=k.history,g=k.location,xa=setInterval,w=setTimeout,la=encodeURIComponent,ma=decodeURIComponent,ba=/\/{2,9}/g,X=navigator.userAgent,o,Y,P=ca(document),ha=P?P.indexOf("?"):-1,$=n.title,L=A.length,T=l,ja=l,aa=m,ta=m,V=l,I=[],f=v();if(F){p=parseFloat(X.substr(X.indexOf("MSIE")+4));if(n.documentMode&&n.documentMode!=p)p=n.documentMode!=8?7:8;c(document).bind("propertychange",
function(){if(n.title!=$&&n.title.indexOf("#"+v())!=-1)n.title=$})}if(Z=ra&&p>=1||F&&p>=6||sa&&p>=9.5||E&&p>=312){for(var u=1;u<L;u++)I.push("");I.push(f);if(sa)history.navigationMode="compatible";if(document.readyState=="complete")var Aa=setInterval(function(){if(c.address){ka();clearInterval(Aa)}},50);else{ia();c(ka)}t=K();if(d.state!==i)if(A.pushState)t.substr(0,3)=="/#/"&&g.replace(d.state.replace(/^\/$/,"")+t.substr(2));else t!="/"&&t.replace(/^\/#/,"")!=J()&&g.replace(d.state.replace(/^\/$/,
"")+"/#"+t);c(window).bind("popstate",ya).bind("unload",za)}else!Z&&J()!=""||E&&p<418&&J()!=""&&g.search!=""?g.replace(g.href.substr(0,g.href.indexOf("#"))):ga();return{bind:function(a,b,e){return z(a,b,e)},init:function(a){return z("init",a)},change:function(a){return z(da,a)},internalChange:function(a){return z(ea,a)},externalChange:function(a){return z(fa,a)},baseURL:function(){var a=g.href;if(a.indexOf("#")!=-1)a=a.substr(0,a.indexOf("#"));if(/\/$/.test(a))a=a.substr(0,a.length-1);return a},autoUpdate:function(a){if(a!==
i){d.autoUpdate=a;return this}return d.autoUpdate},crawlable:function(a){if(a!==i){d.crawlable=a;return this}return d.crawlable},history:function(a){if(a!==i){d.history=a;return this}return d.history},state:function(a){if(a!==i){d.state=a;return this}return d.state},strict:function(a){if(a!==i){d.strict=a;return this}return d.strict},tracker:function(a){if(a!==i){d.tracker=a;return this}return d.tracker},wrap:function(a){if(a!==i){d.wrap=a;return this}return d.wrap},update:function(){V=m;this.value(f);
V=l;return this},encode:function(a){var b=oa(a),e=qa(a),h=R(a),q=U(a),H=a.substr(0,1),N=a.substr(a.length-1),j="";c.each(b,function(x,S){j+="/"+G(S)});if(h!==""){j+="?";if(e.length===0)j+=h;else{c.each(e,function(x,S){x=pa(S,a);if(typeof x!=="string")c.each(x,function(Ca,Ba){j+=G(S)+"="+G(Ba)+"&"});else j+=G(S)+"="+G(x)+"&"});j=j.substr(0,j.length-1)}}if(q!=="")j+="#"+G(q);if(H!="/"&&j.substr(0,1)=="/")j=j.substr(1);if(H=="/"&&j.substr(0,1)!="/")j="/"+j;if(/#|&|\?/.test(N))j+=N;return j},decode:function(a){if(a!==
i){var b=[],e=function(H){return ma(H.toString().replace(/\+/g,"%20"))};if(typeof a=="object"&&a.length!==i){for(var h=0,q=a.length;h<q;h++)b[h]=e(a[h]);return b}else return e(a)}},title:function(a){if(a!==i){w(function(){$=n.title=a;if(ta&&o&&o.contentWindow&&o.contentWindow.document){o.contentWindow.document.title=a;ta=l}if(!aa&&ra)g.replace(g.href.indexOf("#")!=-1?g.href:g.href+"#");aa=l},50);return this}return n.title},value:function(a){if(a!==i){a=this.encode(s(a));if(a=="/")a="";if(f==a&&!V)return;
aa=m;f=a;if(d.autoUpdate||V){M(m);if(B())A[d.history?"pushState":"replaceState"]({},"",d.state.replace(/\/$/,"")+(f==""?"/":f));else{T=m;I[A.length]=f;if(E)if(d.history){g[r][g.pathname]=I.toString();L=A.length+1;if(p<418){if(g.search==""){Y.action="#"+C(f,m);Y.submit()}}else if(p<523||f==""){a=n.createEvent("MouseEvents");a.initEvent("click",m,m);var b=n.createElement("a");b.href="#"+C(f,m);b.dispatchEvent(a)}else g.hash="#"+C(f,m)}else g.replace("#"+C(f,m));else if(f!=v())if(d.history)g.hash="#"+
C(f,m);else g.replace("#"+C(f,m));F&&p<8&&d.history&&w(W,50);if(E)w(function(){T=l},1);else T=l}}return this}if(!Z)return null;return this.decode(s(f))},path:function(a){if(a!==i){var b=R(s(f)),e=U(s(f));this.value(a+(b?"?"+b:"")+(e?"#"+e:""));return this}return this.decode(na(s(f)))},pathNames:function(){return this.decode(oa(s(f)))},queryString:function(a){if(a!==i){var b=U(s(f));this.value(this.path()+(a?"?"+a:"")+(b?"#"+b:""));return this}return this.decode(R(s(f)))},parameter:function(a,b,e){var h,
q;if(b!==i){var H=this.parameterNames();q=[];b=b?la(b):"";for(h=0;h<H.length;h++){var N=H[h],j=this.parameter(N);if(typeof j=="string")j=[j];if(N==a)j=b===null||b===""?[]:e?j.concat([b]):[b];for(var x=0;x<j.length;x++)q.push(N+"="+G(j[x]))}c.inArray(a,H)==-1&&b!==null&&b!==""&&q.push(a+"="+G(b));this.queryString(q.join("&"));return this}return this.decode(pa(a,s(f)))},parameterNames:function(){return this.decode(qa(s(f)))},hash:function(a){if(a!==i){this.value(s(f).split("#")[0]+(a?"#"+a:""));return this}return this.decode(U(s(f)))}}}();
c.fn.address=function(y){if(!c(this).attr("address")){var z=function(B){if(c(this).is("a")){var K=y?y.call(this):/address:/.test(c(this).attr("rel"))?c(this).attr("rel").split("address:")[1].split(" ")[0]:c.address.state()!==undefined&&c.address.state()!="/"?c(this).attr("href").replace(new RegExp("^(.*"+c.address.state()+"|\\.)"),""):c(this).attr("href").replace(/^(#\!?|\.)/,"");c.address.value(K);B.preventDefault()}};c(this).click(z).live("click",z).submit(function(B){if(c(this).is("form")){var K=
y?y.call(this):c(this).attr("action")+"?"+c.address.decode(c(this).serialize());c.address.value(K);B.preventDefault()}}).attr("address",true)}return this}})(jQuery);
/*
 * jQuery UI Effects @VERSION
 *
 * Copyright 2010, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Effects/
 */
;jQuery.effects || (function($, undefined) {

$.effects = {};



/******************************************************************************/
/****************************** COLOR ANIMATIONS ******************************/
/******************************************************************************/

// override the animation for color styles
$.each(['backgroundColor', 'borderBottomColor', 'borderLeftColor',
	'borderRightColor', 'borderTopColor', 'borderColor', 'color', 'outlineColor'],
function(i, attr) {
	$.fx.step[attr] = function(fx) {
		if (!fx.colorInit) {
			fx.start = getColor(fx.elem, attr);
			fx.end = getRGB(fx.end);
			fx.colorInit = true;
		}

		fx.elem.style[attr] = 'rgb(' +
			Math.max(Math.min(parseInt((fx.pos * (fx.end[0] - fx.start[0])) + fx.start[0], 10), 255), 0) + ',' +
			Math.max(Math.min(parseInt((fx.pos * (fx.end[1] - fx.start[1])) + fx.start[1], 10), 255), 0) + ',' +
			Math.max(Math.min(parseInt((fx.pos * (fx.end[2] - fx.start[2])) + fx.start[2], 10), 255), 0) + ')';
	};
});

// Color Conversion functions from highlightFade
// By Blair Mitchelmore
// http://jquery.offput.ca/highlightFade/

// Parse strings looking for color tuples [255,255,255]
function getRGB(color) {
		var result;

		// Check if we're already dealing with an array of colors
		if ( color && color.constructor == Array && color.length == 3 )
				return color;

		// Look for rgb(num,num,num)
		if (result = /rgb\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*\)/.exec(color))
				return [parseInt(result[1],10), parseInt(result[2],10), parseInt(result[3],10)];

		// Look for rgb(num%,num%,num%)
		if (result = /rgb\(\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*\)/.exec(color))
				return [parseFloat(result[1])*2.55, parseFloat(result[2])*2.55, parseFloat(result[3])*2.55];

		// Look for #a0b1c2
		if (result = /#([a-fA-F0-9]{2})([a-fA-F0-9]{2})([a-fA-F0-9]{2})/.exec(color))
				return [parseInt(result[1],16), parseInt(result[2],16), parseInt(result[3],16)];

		// Look for #fff
		if (result = /#([a-fA-F0-9])([a-fA-F0-9])([a-fA-F0-9])/.exec(color))
				return [parseInt(result[1]+result[1],16), parseInt(result[2]+result[2],16), parseInt(result[3]+result[3],16)];

		// Look for rgba(0, 0, 0, 0) == transparent in Safari 3
		if (result = /rgba\(0, 0, 0, 0\)/.exec(color))
				return colors['transparent'];

		// Otherwise, we're most likely dealing with a named color
		return colors[$.trim(color).toLowerCase()];
}

function getColor(elem, attr) {
		var color;

		do {
				color = $.curCSS(elem, attr);

				// Keep going until we find an element that has color, or we hit the body
				if ( color != '' && color != 'transparent' || $.nodeName(elem, "body") )
						break;

				attr = "backgroundColor";
		} while ( elem = elem.parentNode );

		return getRGB(color);
};

// Some named colors to work with
// From Interface by Stefan Petre
// http://interface.eyecon.ro/

var colors = {
	aqua:[0,255,255],
	azure:[240,255,255],
	beige:[245,245,220],
	black:[0,0,0],
	blue:[0,0,255],
	brown:[165,42,42],
	cyan:[0,255,255],
	darkblue:[0,0,139],
	darkcyan:[0,139,139],
	darkgrey:[169,169,169],
	darkgreen:[0,100,0],
	darkkhaki:[189,183,107],
	darkmagenta:[139,0,139],
	darkolivegreen:[85,107,47],
	darkorange:[255,140,0],
	darkorchid:[153,50,204],
	darkred:[139,0,0],
	darksalmon:[233,150,122],
	darkviolet:[148,0,211],
	fuchsia:[255,0,255],
	gold:[255,215,0],
	green:[0,128,0],
	indigo:[75,0,130],
	khaki:[240,230,140],
	lightblue:[173,216,230],
	lightcyan:[224,255,255],
	lightgreen:[144,238,144],
	lightgrey:[211,211,211],
	lightpink:[255,182,193],
	lightyellow:[255,255,224],
	lime:[0,255,0],
	magenta:[255,0,255],
	maroon:[128,0,0],
	navy:[0,0,128],
	olive:[128,128,0],
	orange:[255,165,0],
	pink:[255,192,203],
	purple:[128,0,128],
	violet:[128,0,128],
	red:[255,0,0],
	silver:[192,192,192],
	white:[255,255,255],
	yellow:[255,255,0],
	transparent: [255,255,255]
};



/******************************************************************************/
/****************************** CLASS ANIMATIONS ******************************/
/******************************************************************************/

var classAnimationActions = ['add', 'remove', 'toggle'],
	shorthandStyles = {
		border: 1,
		borderBottom: 1,
		borderColor: 1,
		borderLeft: 1,
		borderRight: 1,
		borderTop: 1,
		borderWidth: 1,
		margin: 1,
		padding: 1
	};

function getElementStyles() {
	var style = document.defaultView
			? document.defaultView.getComputedStyle(this, null)
			: this.currentStyle,
		newStyle = {},
		key,
		camelCase;

	// webkit enumerates style porperties
	if (style && style.length && style[0] && style[style[0]]) {
		var len = style.length;
		while (len--) {
			key = style[len];
			if (typeof style[key] == 'string') {
				camelCase = key.replace(/\-(\w)/g, function(all, letter){
					return letter.toUpperCase();
				});
				newStyle[camelCase] = style[key];
			}
		}
	} else {
		for (key in style) {
			if (typeof style[key] === 'string') {
				newStyle[key] = style[key];
			}
		}
	}
	
	return newStyle;
}

function filterStyles(styles) {
	var name, value;
	for (name in styles) {
		value = styles[name];
		if (
			// ignore null and undefined values
			value == null ||
			// ignore functions (when does this occur?)
			$.isFunction(value) ||
			// shorthand styles that need to be expanded
			name in shorthandStyles ||
			// ignore scrollbars (break in IE)
			(/scrollbar/).test(name) ||

			// only colors or values that can be converted to numbers
			(!(/color/i).test(name) && isNaN(parseFloat(value)))
		) {
			delete styles[name];
		}
	}
	
	return styles;
}

function styleDifference(oldStyle, newStyle) {
	var diff = { _: 0 }, // http://dev.jquery.com/ticket/5459
		name;

	for (name in newStyle) {
		if (oldStyle[name] != newStyle[name]) {
			diff[name] = newStyle[name];
		}
	}

	return diff;
}

$.effects.animateClass = function(value, duration, easing, callback) {
	if ($.isFunction(easing)) {
		callback = easing;
		easing = null;
	}

	return this.each(function() {

		var that = $(this),
			originalStyleAttr = that.attr('style') || ' ',
			originalStyle = filterStyles(getElementStyles.call(this)),
			newStyle,
			className = that.attr('className');

		$.each(classAnimationActions, function(i, action) {
			if (value[action]) {
				that[action + 'Class'](value[action]);
			}
		});
		newStyle = filterStyles(getElementStyles.call(this));
		that.attr('className', className);

		that.animate(styleDifference(originalStyle, newStyle), duration, easing, function() {
			$.each(classAnimationActions, function(i, action) {
				if (value[action]) { that[action + 'Class'](value[action]); }
			});
			// work around bug in IE by clearing the cssText before setting it
			if (typeof that.attr('style') == 'object') {
				that.attr('style').cssText = '';
				that.attr('style').cssText = originalStyleAttr;
			} else {
				that.attr('style', originalStyleAttr);
			}
			if (callback) { callback.apply(this, arguments); }
		});
	});
};

$.fn.extend({
	_addClass: $.fn.addClass,
	addClass: function(classNames, speed, easing, callback) {
		return speed ? $.effects.animateClass.apply(this, [{ add: classNames },speed,easing,callback]) : this._addClass(classNames);
	},

	_removeClass: $.fn.removeClass,
	removeClass: function(classNames,speed,easing,callback) {
		return speed ? $.effects.animateClass.apply(this, [{ remove: classNames },speed,easing,callback]) : this._removeClass(classNames);
	},

	_toggleClass: $.fn.toggleClass,
	toggleClass: function(classNames, force, speed, easing, callback) {
		if ( typeof force == "boolean" || force === undefined ) {
			if ( !speed ) {
				// without speed parameter;
				return this._toggleClass(classNames, force);
			} else {
				return $.effects.animateClass.apply(this, [(force?{add:classNames}:{remove:classNames}),speed,easing,callback]);
			}
		} else {
			// without switch parameter;
			return $.effects.animateClass.apply(this, [{ toggle: classNames },force,speed,easing]);
		}
	},

	switchClass: function(remove,add,speed,easing,callback) {
		return $.effects.animateClass.apply(this, [{ add: add, remove: remove },speed,easing,callback]);
	}
});



/******************************************************************************/
/*********************************** EFFECTS **********************************/
/******************************************************************************/

$.extend($.effects, {
	version: "@VERSION",

	// Saves a set of properties in a data storage
	save: function(element, set) {
		for(var i=0; i < set.length; i++) {
			if(set[i] !== null) element.data("ec.storage."+set[i], element[0].style[set[i]]);
		}
	},

	// Restores a set of previously saved properties from a data storage
	restore: function(element, set) {
		for(var i=0; i < set.length; i++) {
			if(set[i] !== null) element.css(set[i], element.data("ec.storage."+set[i]));
		}
	},

	setMode: function(el, mode) {
		if (mode == 'toggle') mode = el.is(':hidden') ? 'show' : 'hide'; // Set for toggle
		return mode;
	},

	getBaseline: function(origin, original) { // Translates a [top,left] array into a baseline value
		// this should be a little more flexible in the future to handle a string & hash
		var y, x;
		switch (origin[0]) {
			case 'top': y = 0; break;
			case 'middle': y = 0.5; break;
			case 'bottom': y = 1; break;
			default: y = origin[0] / original.height;
		};
		switch (origin[1]) {
			case 'left': x = 0; break;
			case 'center': x = 0.5; break;
			case 'right': x = 1; break;
			default: x = origin[1] / original.width;
		};
		return {x: x, y: y};
	},

	// Wraps the element around a wrapper that copies position properties
	createWrapper: function(element) {

		// if the element is already wrapped, return it
		if (element.parent().is('.ui-effects-wrapper')) {
			return element.parent();
		}

		// wrap the element
		var props = {
				width: element.outerWidth(true),
				height: element.outerHeight(true),
				'float': element.css('float')
			},
			wrapper = $('<div></div>')
				.addClass('ui-effects-wrapper')
				.css({
					fontSize: '100%',
					background: 'transparent',
					border: 'none',
					margin: 0,
					padding: 0
				});

		element.wrap(wrapper);
		wrapper = element.parent(); //Hotfix for jQuery 1.4 since some change in wrap() seems to actually loose the reference to the wrapped element

		// transfer positioning properties to the wrapper
		if (element.css('position') == 'static') {
			wrapper.css({ position: 'relative' });
			element.css({ position: 'relative' });
		} else {
			$.extend(props, {
				position: element.css('position'),
				zIndex: element.css('z-index')
			});
			$.each(['top', 'left', 'bottom', 'right'], function(i, pos) {
				props[pos] = element.css(pos);
				if (isNaN(parseInt(props[pos], 10))) {
					props[pos] = 'auto';
				}
			});
			element.css({position: 'relative', top: 0, left: 0 });
		}

		return wrapper.css(props).show();
	},

	removeWrapper: function(element) {
		if (element.parent().is('.ui-effects-wrapper'))
			return element.parent().replaceWith(element);
		return element;
	},

	setTransition: function(element, list, factor, value) {
		value = value || {};
		$.each(list, function(i, x){
			unit = element.cssUnit(x);
			if (unit[0] > 0) value[x] = unit[0] * factor + unit[1];
		});
		return value;
	}
});


function _normalizeArguments(effect, options, speed, callback) {
	// shift params for method overloading
	if (typeof effect == 'object') {
		callback = options;
		speed = null;
		options = effect;
		effect = options.effect;
	}
	if ($.isFunction(options)) {
		callback = options;
		speed = null;
		options = {};
	}
        if (typeof options == 'number' || $.fx.speeds[options]) {
		callback = speed;
		speed = options;
		options = {};
	}
	if ($.isFunction(speed)) {
		callback = speed;
		speed = null;
	}

	options = options || {};

	speed = speed || options.duration;
	speed = $.fx.off ? 0 : typeof speed == 'number'
		? speed : $.fx.speeds[speed] || $.fx.speeds._default;

	callback = callback || options.complete;

	return [effect, options, speed, callback];
}

function standardSpeed( speed ) {
	// valid standard speeds
	if ( !speed || typeof speed === "number" || $.fx.speeds[ speed ] ) {
		return true;
	}
	
	// invalid strings - treat as "normal" speed
	if ( typeof speed === "string" && !$.effects[ speed ] ) {
		return true;
	}
	
	return false;
}

$.fn.extend({
	effect: function(effect, options, speed, callback) {
		var args = _normalizeArguments.apply(this, arguments),
			// TODO: make effects take actual parameters instead of a hash
			args2 = {
				options: args[1],
				duration: args[2],
				callback: args[3]
			},
			mode = args2.options.mode,
			effectMethod = $.effects[effect];
		
		if ( $.fx.off || !effectMethod ) {
			// delegate to the original method (e.g., .show()) if possible
			if ( mode ) {
				return this[ mode ]( args2.duration, args2.callback );
			} else {
				return this.each(function() {
					if ( args2.callback ) {
						args2.callback.call( this );
					}
				});
			}
		}
		
		return effectMethod.call(this, args2);
	},

	_show: $.fn.show,
	show: function(speed) {
		if ( standardSpeed( speed ) ) {
			return this._show.apply(this, arguments);
		} else {
			var args = _normalizeArguments.apply(this, arguments);
			args[1].mode = 'show';
			return this.effect.apply(this, args);
		}
	},

	_hide: $.fn.hide,
	hide: function(speed) {
		if ( standardSpeed( speed ) ) {
			return this._hide.apply(this, arguments);
		} else {
			var args = _normalizeArguments.apply(this, arguments);
			args[1].mode = 'hide';
			return this.effect.apply(this, args);
		}
	},

	// jQuery core overloads toggle and creates _toggle
	__toggle: $.fn.toggle,
	toggle: function(speed) {
		if ( standardSpeed( speed ) || typeof speed === "boolean" || $.isFunction( speed ) ) {
			return this.__toggle.apply(this, arguments);
		} else {
			var args = _normalizeArguments.apply(this, arguments);
			args[1].mode = 'toggle';
			return this.effect.apply(this, args);
		}
	},

	// helper functions
	cssUnit: function(key) {
		var style = this.css(key), val = [];
		$.each( ['em','px','%','pt'], function(i, unit){
			if(style.indexOf(unit) > 0)
				val = [parseFloat(style), unit];
		});
		return val;
	}
});



/******************************************************************************/
/*********************************** EASING ***********************************/
/******************************************************************************/

/*
 * jQuery Easing v1.3 - http://gsgd.co.uk/sandbox/jquery/easing/
 *
 * Uses the built in easing capabilities added In jQuery 1.1
 * to offer multiple easing options
 *
 * TERMS OF USE - jQuery Easing
 *
 * Open source under the BSD License.
 *
 * Copyright 2008 George McGinley Smith
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification,
 * are permitted provided that the following conditions are met:
 *
 * Redistributions of source code must retain the above copyright notice, this list of
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list
 * of conditions and the following disclaimer in the documentation and/or other materials
 * provided with the distribution.
 *
 * Neither the name of the author nor the names of contributors may be used to endorse
 * or promote products derived from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 * EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 * GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 * NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED
 * OF THE POSSIBILITY OF SUCH DAMAGE.
 *
*/

// t: current time, b: begInnIng value, c: change In value, d: duration
$.easing.jswing = $.easing.swing;

$.extend($.easing,
{
	def: 'easeOutQuad',
	swing: function (x, t, b, c, d) {
		//alert($.easing.default);
		return $.easing[$.easing.def](x, t, b, c, d);
	},
	easeInQuad: function (x, t, b, c, d) {
		return c*(t/=d)*t + b;
	},
	easeOutQuad: function (x, t, b, c, d) {
		return -c *(t/=d)*(t-2) + b;
	},
	easeInOutQuad: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t + b;
		return -c/2 * ((--t)*(t-2) - 1) + b;
	},
	easeInCubic: function (x, t, b, c, d) {
		return c*(t/=d)*t*t + b;
	},
	easeOutCubic: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t + 1) + b;
	},
	easeInOutCubic: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t + b;
		return c/2*((t-=2)*t*t + 2) + b;
	},
	easeInQuart: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t + b;
	},
	easeOutQuart: function (x, t, b, c, d) {
		return -c * ((t=t/d-1)*t*t*t - 1) + b;
	},
	easeInOutQuart: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t + b;
		return -c/2 * ((t-=2)*t*t*t - 2) + b;
	},
	easeInQuint: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t*t + b;
	},
	easeOutQuint: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t*t*t + 1) + b;
	},
	easeInOutQuint: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t*t + b;
		return c/2*((t-=2)*t*t*t*t + 2) + b;
	},
	easeInSine: function (x, t, b, c, d) {
		return -c * Math.cos(t/d * (Math.PI/2)) + c + b;
	},
	easeOutSine: function (x, t, b, c, d) {
		return c * Math.sin(t/d * (Math.PI/2)) + b;
	},
	easeInOutSine: function (x, t, b, c, d) {
		return -c/2 * (Math.cos(Math.PI*t/d) - 1) + b;
	},
	easeInExpo: function (x, t, b, c, d) {
		return (t==0) ? b : c * Math.pow(2, 10 * (t/d - 1)) + b;
	},
	easeOutExpo: function (x, t, b, c, d) {
		return (t==d) ? b+c : c * (-Math.pow(2, -10 * t/d) + 1) + b;
	},
	easeInOutExpo: function (x, t, b, c, d) {
		if (t==0) return b;
		if (t==d) return b+c;
		if ((t/=d/2) < 1) return c/2 * Math.pow(2, 10 * (t - 1)) + b;
		return c/2 * (-Math.pow(2, -10 * --t) + 2) + b;
	},
	easeInCirc: function (x, t, b, c, d) {
		return -c * (Math.sqrt(1 - (t/=d)*t) - 1) + b;
	},
	easeOutCirc: function (x, t, b, c, d) {
		return c * Math.sqrt(1 - (t=t/d-1)*t) + b;
	},
	easeInOutCirc: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return -c/2 * (Math.sqrt(1 - t*t) - 1) + b;
		return c/2 * (Math.sqrt(1 - (t-=2)*t) + 1) + b;
	},
	easeInElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return -(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
	},
	easeOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
	},
	easeInOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d/2)==2) return b+c;  if (!p) p=d*(.3*1.5);
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		if (t < 1) return -.5*(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
		return a*Math.pow(2,-10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )*.5 + c + b;
	},
	easeInBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*(t/=d)*t*((s+1)*t - s) + b;
	},
	easeOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*((t=t/d-1)*t*((s+1)*t + s) + 1) + b;
	},
	easeInOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		if ((t/=d/2) < 1) return c/2*(t*t*(((s*=(1.525))+1)*t - s)) + b;
		return c/2*((t-=2)*t*(((s*=(1.525))+1)*t + s) + 2) + b;
	},
	easeInBounce: function (x, t, b, c, d) {
		return c - $.easing.easeOutBounce (x, d-t, 0, c, d) + b;
	},
	easeOutBounce: function (x, t, b, c, d) {
		if ((t/=d) < (1/2.75)) {
			return c*(7.5625*t*t) + b;
		} else if (t < (2/2.75)) {
			return c*(7.5625*(t-=(1.5/2.75))*t + .75) + b;
		} else if (t < (2.5/2.75)) {
			return c*(7.5625*(t-=(2.25/2.75))*t + .9375) + b;
		} else {
			return c*(7.5625*(t-=(2.625/2.75))*t + .984375) + b;
		}
	},
	easeInOutBounce: function (x, t, b, c, d) {
		if (t < d/2) return $.easing.easeInBounce (x, t*2, 0, c, d) * .5 + b;
		return $.easing.easeOutBounce (x, t*2-d, 0, c, d) * .5 + c*.5 + b;
	}
});

/*
 *
 * TERMS OF USE - EASING EQUATIONS
 *
 * Open source under the BSD License.
 *
 * Copyright 2001 Robert Penner
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification,
 * are permitted provided that the following conditions are met:
 *
 * Redistributions of source code must retain the above copyright notice, this list of
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list
 * of conditions and the following disclaimer in the documentation and/or other materials
 * provided with the distribution.
 *
 * Neither the name of the author nor the names of contributors may be used to endorse
 * or promote products derived from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 * EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 * GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 * NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED
 * OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 */

})(jQuery);
/*!
 * Tabulator RDF library
 * 
 * See: http://www.w3.org/2005/ajar/tab
 * 
 * License:
 * 
 * W3C Software Notice and License
 * 
 * This work (and included software, documentation such as READMEs, or other related items) is being provided by the copyright holders under the following license.
 * License
 * 
 * By obtaining, using and/or copying this work, you (the licensee) agree that you have read, understood, and will comply with the following terms and conditions.
 * 
 * Permission to copy, modify, and distribute this software and its documentation, with or without modification, for any purpose and without fee or royalty is hereby granted, provided that you include the following on ALL copies of the software and documentation or portions thereof, including modifications:
 * 
 *     * The full text of this NOTICE in a location viewable to users of the redistributed or derivative work.
 *     * Any pre-existing intellectual property disclaimers, notices, or terms and conditions. If none exist, the W3C Software Short Notice should be included (hypertext is preferred, text is permitted) within the body of any redistributed or derivative code.
 *     * Notice of any changes or modifications to the files, including the date changes were made. (We recommend you provide URIs to the location from which the code is derived.)
 * 
 * Disclaimers
 * 
 * THIS SOFTWARE AND DOCUMENTATION IS PROVIDED "AS IS," AND COPYRIGHT HOLDERS MAKE NO REPRESENTATIONS OR WARRANTIES, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO, WARRANTIES OF MERCHANTABILITY OR FITNESS FOR ANY PARTICULAR PURPOSE OR THAT THE USE OF THE SOFTWARE OR DOCUMENTATION WILL NOT INFRINGE ANY THIRD PARTY PATENTS, COPYRIGHTS, TRADEMARKS OR OTHER RIGHTS.
 * 
 * COPYRIGHT HOLDERS WILL NOT BE LIABLE FOR ANY DIRECT, INDIRECT, SPECIAL OR CONSEQUENTIAL DAMAGES ARISING OUT OF ANY USE OF THE SOFTWARE OR DOCUMENTATION.
 * 
 * The name and trademarks of copyright holders may NOT be used in advertising or publicity pertaining to the software without specific, written prior permission. Title to copyright in this software and any associated documentation will at all times remain with copyright holders.
 * Notes
 * 
 * This version: http://www.w3.org/Consortium/Legal/2002/copyright-software-20021231
 * 
 * This formulation of W3C's notice and license became active on December 31 2002. This version removes the copyright ownership notice such that this license can be used with materials other than those owned by the W3C, reflects that ERCIM is now a host of the W3C, includes references to this specific dated version of the license, and removes the ambiguous grant of "use". Otherwise, this version is the same as the previous version and is written so as to preserve the Free Software Foundation's assessment of GPL compatibility and OSI's certification under the Open Source Definition.
 */
 /**
* Utility functions for $rdf
 */

if (typeof isExtension == 'undefined') isExtension = false; // stand-alone library

if( typeof $rdf == 'undefined' ) {
    $rdf = {};
}

/**
 * @class a dummy logger
 
 Note to implement this using the Firefox error console see
  https://developer.mozilla.org/en/nsIConsoleService
 */

$rdf.log = {
    'debug':function(x) {return;},
    'warn':function(x) {return;},
    'info':function(x) {return;},
    'error':function(x) {return;},
    'success':function(x) {return;},
    'msg':function(x) {return;}
}

 
/**
* @class A utility class
 */


$rdf.Util = {
    /** A simple debugging function */         
    'output': function (o) {
	    var k = document.createElement('div')
	    k.textContent = o
	    document.body.appendChild(k)
	},
    /**
    * A standard way to add callback functionality to an object
     **
     ** Callback functions are indexed by a 'hook' string.
     **
     ** They return true if they want to be called again.
     **
     */
    'callbackify': function (obj,callbacks) {
	    obj.callbacks = {}
	    for (var x=callbacks.length-1; x>=0; x--) {
            obj.callbacks[callbacks[x]] = []
	    }
	    
	    obj.addHook = function (hook) {
            if (!obj.callbacks[hook]) { obj.callbacks[hook] = [] }
	    }
        
	    obj.addCallback = function (hook, func) {
            obj.callbacks[hook].push(func)
	    }
        
        obj.removeCallback = function (hook, funcName) {
            for (var i=0;i<obj.callbacks[hook].length;i++){
                //alert(obj.callbacks[hook][i].name);
                if (obj.callbacks[hook][i].name==funcName){
                    
                    obj.callbacks[hook].splice(i,1);
                    return true;
                }
            }
            return false; 
        }
        obj.insertCallback=function (hook,func){
            obj.callbacks[hook].unshift(func);
        }
	    obj.fireCallbacks = function (hook, args) {
            var newCallbacks = []
            var replaceCallbacks = []
            var len = obj.callbacks[hook].length
            //	    $rdf.log.info('!@$ Firing '+hook+' call back with length'+len);
            for (var x=len-1; x>=0; x--) {
                //		    $rdf.log.info('@@ Firing '+hook+' callback '+ obj.callbacks[hook][x])
                if (obj.callbacks[hook][x].apply(obj,args)) {
                    newCallbacks.push(obj.callbacks[hook][x])
                }
            }
            
            for (var x=newCallbacks.length-1; x>=0; x--) {
                replaceCallbacks.push(newCallbacks[x])
            }
            
            for (var x=len; x<obj.callbacks[hook].length; x++) {
                replaceCallbacks.push(obj.callbacks[hook][x])
            }
            
            obj.callbacks[hook] = replaceCallbacks
	    }
	},
    
    /**
    * A standard way to create XMLHttpRequest objects
     */
	'XMLHTTPFactory': function () {
        if (isExtension) {
            return Components.
            classes["@mozilla.org/xmlextras/xmlhttprequest;1"].
            createInstance().QueryInterface(Components.interfaces.nsIXMLHttpRequest);
        } else if (window.XMLHttpRequest) {
            try {
                return new XMLHttpRequest()
            } catch (e) {
                return false
            }
	    }
	    else if (window.ActiveXObject) {
            try {
                return new ActiveXObject("Msxml2.XMLHTTP")
            } catch (e) {
                try {
                    return new ActiveXObject("Microsoft.XMLHTTP")
                } catch (e) {
                    return false
                }
            }
	    }
	    else {
            return false
	    }
	},

	'DOMParserFactory': function () {
        if(isExtension) {
            return Components.classes["@mozilla.org/xmlextras/domparser;1"]
            .getService(Components.interfaces.nsIDOMParser);
        } else if ( window.DOMParser ){
		    return new DOMParser();
        } else if ( window.ActiveXObject ) {
            return new ActiveXObject( "Microsoft.XMLDOM" );
        } else {
            return false;
	    }
	},
    /**
    * Returns a hash of headers and values
    **
    ** @@ Bug: Assumes that each header only occurs once
    ** Also note that a , in a header value is just the same as having two headers.
     */
	'getHTTPHeaders': function (xhr) {
	    var lines = xhr.getAllResponseHeaders().split("\n")
	    var headers = {}
	    var last = undefined
	    for (var x=0; x<lines.length; x++) {
            if (lines[x].length > 0) {
                var pair = lines[x].split(': ')
                if (typeof pair[1] == "undefined") { // continuation
                    headers[last] += "\n"+pair[0]
                } else {
                    last = pair[0].toLowerCase()
                    headers[last] = pair[1]
                }
            }
	    }
	    return headers
	},
    
    'dtstamp': function () {
	    var now = new Date();
	    var year  = now.getYear() + 1900;
	    var month = now.getMonth() + 1;
	    var day  = now.getDate();
	    var hour = now.getUTCHours();
	    var minute = now.getUTCMinutes();
	    var second = now.getSeconds();
	    if (month < 10) month = "0" + month;
	    if (day < 10) day = "0" + day;
	    if (hour < 10) hour = "0" + hour;
	    if (minute < 10) minute = "0" + minute;
	    if (second < 10) second = "0" + second;
	    return year + "-" + month + "-" + day + "T"
            + hour + ":" + minute + ":" + second + "Z";
	},
    
    'enablePrivilege': ((typeof netscape != 'undefined') && netscape.security.PrivilegeManager.enablePrivilege) || function() { return; },
    'disablePrivilege': ((typeof netscape != 'undefined') && netscape.security.PrivilegeManager.disablePrivilege) || function() { return; },



    'RDFArrayRemove': function(a, x) {  //removes all statements equal to x from a
        for(var i=0; i<a.length; i++) {
            //TODO: This used to be the following, which didnt always work..why
            //if(a[i] == x)
            if (a[i].subject.sameTerm( x.subject ) && 
                a[i].predicate.sameTerm( x.predicate ) && 
                a[i].object.sameTerm( x.object ) &&
                a[i].why.sameTerm( x.why )) {
                a.splice(i,1);
                return;
            }
        }
        throw "RDFArrayRemove: Array did not contain " + x;
    },

    'string_startswith': function(str, pref) { // missing library routines
        return (str.slice(0, pref.length) == pref);
    },

    // This is the callback from the kb to the fetcher which is used to 
    // load ontologies of the data we load.
    'AJAR_handleNewTerm': function(kb, p, requestedBy) {
        var sf = null;
        if( typeof kb.sf != 'undefined' ) {
            sf = kb.sf;
        } else {
            return;
        }
        if (p.termType != 'symbol') return;
        var docuri = $rdf.Util.uri.docpart(p.uri);
        var fixuri;
        if (p.uri.indexOf('#') < 0) { // No hash
            
            // @@ major hack for dbpedia Categories, which spread indefinitely
            if ($rdf.Util.string_startswith(p.uri, 'http://dbpedia.org/resource/Category:')) return;  
            
            /*
              if (string_startswith(p.uri, 'http://xmlns.com/foaf/0.1/')) {
              fixuri = "http://dig.csail.mit.edu/2005/ajar/ajaw/test/foaf"
              // should give HTTP 303 to ontology -- now is :-)
              } else
            */
            if ($rdf.Util.string_startswith(p.uri, 'http://purl.org/dc/elements/1.1/')
                || $rdf.Util.string_startswith(p.uri, 'http://purl.org/dc/terms/')) {
                fixuri = "http://dublincore.org/2005/06/13/dcq";
                //dc fetched multiple times
            } else if ($rdf.Util.string_startswith(p.uri, 'http://xmlns.com/wot/0.1/')) {
            fixuri = "http://xmlns.com/wot/0.1/index.rdf";
            } else if ($rdf.Util.string_startswith(p.uri, 'http://web.resource.org/cc/')) {
                //            $rdf.log.warn("creative commons links to html instead of rdf. doesn't seem to content-negotiate.");
                fixuri = "http://web.resource.org/cc/schema.rdf";
            }
        }
        if (fixuri) {
            docuri = fixuri
        }
        if (sf && sf.getState(docuri) != 'unrequested') return;
        
        if (fixuri) {   // only give warning once: else happens too often
            $rdf.log.warn("Assuming server still broken, faking redirect of <" + p.uri +
                               "> to <" + docuri + ">")	
                }
        sf.requestURI(docuri, requestedBy);
    }, //AJAR_handleNewTerm
    'ArrayIndexOf': function(arr, item, i) {
        i || (i = 0);
        var length = arr.length;
        if (i < 0) i = length + i;
        for (; i < length; i++)
            if (arr[i] === item) return i;
        return -1;
    }
    
};

//////////////////////String Utility
// substitutes given terms for occurrnces of %s
// not well named. Used??? - tim
//
$rdf.Util.string = {
    //C++, python style %s -> subs
    'template': function(base, subs){
        var baseA = base.split("%s");
        var result = "";
        for (var i=0;i<subs.length;i++){
            subs[i] += '';
            result += baseA[i] + subs[i];
        }
        return result + baseA.slice(subs.length).join(); 
    }
};

// from http://dev.jquery.com/browser/trunk/jquery/src/core.js
// Overlap with JQuery -- we try to keep the rdflib.js and jquery libraries separate at the moment.
$rdf.Util.extend = function () {
    // copy reference to target object
    var target = arguments[0] || {},
        i = 1,
        length = arguments.length,
        deep = false,
        options, name, src, copy;

    // Handle a deep copy situation
    if (typeof target === "boolean") {
        deep = target;
        target = arguments[1] || {};
        // skip the boolean and the target
        i = 2;
    }

    // Handle case when target is a string or something (possible in deep copy)
    if (typeof target !== "object" && !jQuery.isFunction(target)) {
        target = {};
    }

    // extend jQuery itself if only one argument is passed
    if (length === i) {
        target = this;
        --i;
    }

    for (; i < length; i++) {
        // Only deal with non-null/undefined values
        if ((options = arguments[i]) != null) {
            // Extend the base object
            for (name in options) {
                src = target[name];
                copy = options[name];

                // Prevent never-ending loop
                if (target === copy) {
                    continue;
                }

                // Recurse if we're merging object values
                if (deep && copy && typeof copy === "object" && !copy.nodeType) {
                    var clone;

                    if (src) {
                        clone = src;
                    } else if (jQuery.isArray(copy)) {
                        clone = [];
                    } else if (jQuery.isObject(copy)) {
                        clone = {};
                    } else {
                        clone = copy;
                    }

                    // Never move original objects, clone them
                    target[name] = jQuery.extend(deep, clone, copy);

                    // Don't bring in undefined values
                } else if (copy !== undefined) {
                    target[name] = copy;
                }
            }
        }
    }

    // Return the modified object
    return target;
};





//  Implementing URI-specific functions
//
//	See RFC 2386
//
// This is or was   http://www.w3.org/2005/10/ajaw/uri.js
// 2005 W3C open source licence
//
//
//  Take a URI given in relative or absolute form and a base
//  URI, and return an absolute URI
//
//  See also http://www.w3.org/2000/10/swap/uripath.py
//

if (typeof $rdf.Util.uri == "undefined") { $rdf.Util.uri = {}; };

$rdf.Util.uri.join = function (given, base) {
    // if (typeof $rdf.log.debug != 'undefined') $rdf.log.debug("   URI given="+given+" base="+base)
    var baseHash = base.indexOf('#')
    if (baseHash > 0) base = base.slice(0, baseHash)
    if (given.length==0) return base // before chopping its filename off
    if (given.indexOf('#')==0) return base + given
    var colon = given.indexOf(':')
    if (colon >= 0) return given	// Absolute URI form overrides base URI
    var baseColon = base.indexOf(':')
    if (base == "") return given;
    if (baseColon < 0) {
        alert("Invalid base: "+ base + ' in join with ' +given);
        return given
    }
    var baseScheme = base.slice(0,baseColon+1)  // eg http:
    if (given.indexOf("//") == 0)     // Starts with //
	return baseScheme + given;
    if (base.indexOf('//', baseColon)==baseColon+1) {  // Any hostpart?
	    var baseSingle = base.indexOf("/", baseColon+3)
	if (baseSingle < 0) {
	    if (base.length-baseColon-3 > 0) {
		return base + "/" + given
	    } else {
		return baseScheme + given
	    }
	}
    } else {
	var baseSingle = base.indexOf("/", baseColon+1)
	if (baseSingle < 0) {
	    if (base.length-baseColon-1 > 0) {
		return base + "/" + given
	    } else {
		return baseScheme + given
	    }
	}
    }

    if (given.indexOf('/') == 0)	// starts with / but not //
	return base.slice(0, baseSingle) + given
    
    var path = base.slice(baseSingle)
    var lastSlash = path.lastIndexOf("/")
    if (lastSlash <0) return baseScheme + given
    if ((lastSlash >=0) && (lastSlash < (path.length-1)))
	path = path.slice(0, lastSlash+1) // Chop trailing filename from base
    
    path = path + given
    while (path.match(/[^\/]*\/\.\.\//)) // must apply to result of prev
	path = path.replace( /[^\/]*\/\.\.\//, '') // ECMAscript spec 7.8.5
    path = path.replace( /\.\//g, '') // spec vague on escaping
    path = path.replace( /\/\.$/, '/' )
    return base.slice(0, baseSingle) + path
}

if (isExtension) {
    $rdf.Util.uri.join2 = function (given, base){
        var tIOService = Components.classes['@mozilla.org/network/io-service;1']
                        .getService(Components.interfaces.nsIIOService);

        var baseURI = tIOService.newURI(base, null, null);
        return tIOService.newURI(baseURI.resolve(given), null, null).spec;
    }
} else
    $rdf.Util.uri.join2 = $rdf.Util.uri.join;
    
//  refTo:    Make a URI relative to a given base
//
// based on code in http://www.w3.org/2000/10/swap/uripath.py
//
$rdf.Util.uri.commonHost = new RegExp("^[-_a-zA-Z0-9.]+:(//[^/]*)?/[^/]*$");
$rdf.Util.uri.refTo = function(base, uri) {
    if (!base) return uri;
    if (base == uri) return "";
    var i =0; // How much are they identical?
    while (i<uri.length && i < base.length)
        if (uri[i] == base[i]) i++;
        else break;
    if (base.slice(0,i).match($rdf.Util.uri.commonHost)) {
        var k = uri.indexOf('//');
        if (k<0) k=-2; // no host
        var l = uri.indexOf('/', k+2);   // First *single* slash
        if (uri.slice(l+1, l+2) != '/' && base.slice(l+1, l+2) != '/'
                           && uri.slice(0,l) == base.slice(0,l)) // common path to single slash
            return uri.slice(l); // but no other common path segments
    }
     // fragment of base?
    if (uri.slice(i, i+1) == '#' && base.length == i) return uri.slice(i);
    while (i>0 && uri[i-1] != '/') i--;

    if (i<3) return uri; // No way
    if ((base.indexOf('//', i-2) > 0) || uri.indexOf('//', i-2) > 0)
        return uri; // an unshared '//'
    if (base.indexOf(':', i) >0) return uri; // unshared ':'
    var n = 0;
    for (var j=i; j<base.length; j++) if (base[j]=='/') n++;
    if (n==0 && i < uri.length && uri[i] =='#') return './' + uri.slice(i);
    if (n==0 && i == uri.length) return './';
    var str = '';
    for (var j=0; j<n; j++) str+= '../';
    return str + uri.slice(i);
}


/** returns URI without the frag **/
$rdf.Util.uri.docpart = function (uri) {
    var i = uri.indexOf("#")
    if (i < 0) return uri
    return uri.slice(0,i)
} 

/** The document in which something a thing defined  **/
$rdf.Util.uri.document = function (x) {
    return $rdf.sym($rdf.Util.uri.docpart(x.uri));
} 

/** return the protocol of a uri **/
/** return null if there isn't one **/
$rdf.Util.uri.protocol = function (uri) {
    var index = uri.indexOf(':');
    if (index >= 0)
        return uri.slice(0, index);
    else
        return null;
} //protocol

//ends
// These are the classes corresponding to the RDF and N3 data models
//
// Designed to look like rdflib and cwm designs.
//
// Issues: Should the names start with RDF to make them
//      unique as program-wide symbols?
//
// W3C open source licence 2005.
//

//	Symbol

$rdf.Empty = function() {
	return this;
};

$rdf.Empty.prototype.termType = 'empty';
$rdf.Empty.prototype.toString = function () { return "()" };
$rdf.Empty.prototype.toNT = $rdf.Empty.prototype.toString;

$rdf.Symbol = function( uri ) {
    this.uri = uri;
    this.value = uri;   // -- why? -tim
    return this;
}

$rdf.Symbol.prototype.termType = 'symbol';
$rdf.Symbol.prototype.toString = function () { return ("<" + this.uri + ">"); };
$rdf.Symbol.prototype.toNT = $rdf.Symbol.prototype.toString;

//  Some precalculated symbols
$rdf.Symbol.prototype.XSDboolean = new $rdf.Symbol('http://www.w3.org/2001/XMLSchema#boolean');
$rdf.Symbol.prototype.XSDdecimal = new $rdf.Symbol('http://www.w3.org/2001/XMLSchema#decimal');
$rdf.Symbol.prototype.XSDfloat = new $rdf.Symbol('http://www.w3.org/2001/XMLSchema#float');
$rdf.Symbol.prototype.XSDinteger = new $rdf.Symbol('http://www.w3.org/2001/XMLSchema#integer');
$rdf.Symbol.prototype.XSDdateTime = new $rdf.Symbol('http://www.w3.org/2001/XMLSchema#dateTime');
$rdf.Symbol.prototype.integer = new $rdf.Symbol('http://www.w3.org/2001/XMLSchema#integer'); // Used?

//	Blank Node

if (typeof $rdf.NextId != 'undefined') {
    $rdf.log.error('Attempt to re-zero existing blank node id counter at '+$rdf.NextId);
} else {
    $rdf.NextId = 0;  // Global genid
}
$rdf.NTAnonymousNodePrefix = "_:n";

$rdf.BlankNode = function ( id ) {
    /*if (id)
    	this.id = id;
    else*/
    this.id = $rdf.NextId++
    this.value = id ? id : this.id.toString();
    return this
};

$rdf.BlankNode.prototype.termType = 'bnode';
$rdf.BlankNode.prototype.toNT = function() {
    return $rdf.NTAnonymousNodePrefix + this.id
};
$rdf.BlankNode.prototype.toString = $rdf.BlankNode.prototype.toNT;

//	Literal

$rdf.Literal = function (value, lang, datatype) {
    this.value = value
    if (lang == "" || lang == null) this.lang = undefined;
    else this.lang = lang;	  // string
    if (datatype == null) this.datatype = undefined;
    else this.datatype = datatype;  // term
    return this;
}

$rdf.Literal.prototype.termType = 'literal'    
$rdf.Literal.prototype.toString = function() {
    return ''+this.value;
};
$rdf.Literal.prototype.toNT = function() {
    var str = this.value
    if (typeof str != 'string') {
        if (typeof str == 'number') return ''+str;
	throw Error("Value of RDF literal is not string: "+str)
    }
    str = str.replace(/\\/g, '\\\\');  // escape backslashes
    str = str.replace(/\"/g, '\\"');    // escape quotes
    str = str.replace(/\n/g, '\\n');    // escape newlines
    str = '"' + str + '"'  //';

    if (this.datatype){
        str = str + '^^' + this.datatype.toNT()
    }
    if (this.lang) {
        str = str + "@" + this.lang;
    }
    return str;
};

$rdf.Collection = function() {
    this.id = $rdf.NextId++;  // Why need an id? For hashstring.
    this.elements = [];
    this.closed = false;
};

$rdf.Collection.prototype.termType = 'collection';

$rdf.Collection.prototype.toNT = function() {
    return $rdf.NTAnonymousNodePrefix + this.id
};

$rdf.Collection.prototype.toString = function() {
    var str='(';
    for (var i=0; i<this.elements.length; i++)
        str+= this.elements[i] + ' ';
    return str + ')';
};

$rdf.Collection.prototype.append = function (el) {
    this.elements.push(el)
}
$rdf.Collection.prototype.unshift=function(el){
    this.elements.unshift(el);
}
$rdf.Collection.prototype.shift=function(){
    return this.elements.shift();
}
        
$rdf.Collection.prototype.close = function () {
    this.closed = true
}


//      Convert Javascript representation to RDF term object
//
$rdf.term = function(val) {
    if (typeof val == 'object')
        if (val instanceof Date) {
            var d2=function(x) {return(''+(100+x)).slice(1,3)};  // format as just two digits
            return new $rdf.Literal(
                    ''+ val.getUTCFullYear() + '-'+
                    d2(val.getUTCMonth()+1) +'-'+d2(val.getUTCDate())+
                    'T'+d2(val.getUTCHours())+':'+d2(val.getUTCMinutes())+
                    ':'+d2(val.getUTCSeconds())+'Z',
            undefined, $rdf.Symbol.prototype.XSDdateTime);

        }
        else if (val instanceof Array) {
            var x = new $rdf.Collection();
            for (var i=0; i<val.length; i++) x.append($rdf.term(val[i]));
            return x;
        }
        else return val;
    if (typeof val == 'string') return new $rdf.Literal(val);
    if (typeof val == 'number') {
        var dt;
        if ((''+val).indexOf('e')>=0) dt = $rdf.Symbol.prototype.XSDfloat;
        else if ((''+val).indexOf('.')>=0) dt = $rdf.Symbol.prototype.XSDdecimal;
        else dt = $rdf.Symbol.prototype.XSDinteger;
        return new $rdf.Literal(val, undefined, dt);
    }
    if (typeof val == 'boolean') return new $rdf.Literal(val?"1":"0", undefined, 
                                                       $rdf.Symbol.prototype.XSDboolean);
    if (typeof val == 'undefined') return undefined;
    throw ("Can't make term from " + val + " of type " + typeof val);
}

//	Statement
//
//  This is a triple with an optional reason.
//
//   The reason can point to provenece or inference
//

$rdf.Statement = function(subject, predicate, object, why) {
    this.subject = $rdf.term(subject)
    this.predicate = $rdf.term(predicate)
    this.object = $rdf.term(object)
    if (typeof why !='undefined') {
        this.why = why;
    }
    return this;
}

$rdf.st= function(subject, predicate, object, why) {
    return new $rdf.Statement(subject, predicate, object, why);
};

$rdf.Statement.prototype.toNT = function() {
    return (this.subject.toNT() + " "
            + this.predicate.toNT() + " "
            +  this.object.toNT() +" .");
};

$rdf.Statement.prototype.toString = $rdf.Statement.prototype.toNT;

//	Formula
//
//	Set of statements.

$rdf.Formula = function() {
    this.statements = []
    this.constraints = []
    this.initBindings = []
    this.optional = []
    return this;
};


$rdf.Formula.prototype.termType = 'formula';
$rdf.Formula.prototype.toNT = function() {
    return "{" + this.statements.join('\n') + "}"
};
$rdf.Formula.prototype.toString = $rdf.Formula.prototype.toNT;

$rdf.Formula.prototype.add = function(subj, pred, obj, why) {
    this.statements.push(new $rdf.Statement(subj, pred, obj, why))
}

// Convenience methods on a formula allow the creation of new RDF terms:

$rdf.Formula.prototype.sym = function(uri,name) {
    if (name != null) {
        throw "This feature (kb.sym with 2 args) is removed. Do not assume prefix mappings."
        if (!$rdf.ns[uri]) throw 'The prefix "'+uri+'" is not set in the API';
        uri = $rdf.ns[uri] + name
    }
    return new $rdf.Symbol(uri)
}

$rdf.sym = function(uri) { return new $rdf.Symbol(uri); };

$rdf.Formula.prototype.literal = function(val, lang, dt) {
    return new $rdf.Literal(val.toString(), lang, dt)
}
$rdf.lit = $rdf.Formula.prototype.literal;

$rdf.Formula.prototype.bnode = function(id) {
    return new $rdf.BlankNode(id)
}

$rdf.Formula.prototype.formula = function() {
    return new $rdf.Formula()
}

$rdf.Formula.prototype.collection = function () { // obsolete
    return new $rdf.Collection()
}

$rdf.Formula.prototype.list = function (values) {
    li = new $rdf.Collection();
    if (values) {
        for(var i = 0; i<values.length; i++) {
            li.append(values[i]);
        }
    }
    return li;
}

/*  Variable
**
** Variables are placeholders used in patterns to be matched.
** In cwm they are symbols which are the formula's list of quantified variables.
** In sparl they are not visibily URIs.  Here we compromise, by having
** a common special base URI for variables. Their names are uris,
** but the ? nottaion has an implicit base uri of 'varid:'
*/

$rdf.Variable = function(rel) {
    this.base = "varid:"; // We deem variabe x to be the symbol varid:x 
    this.uri = $rdf.Util.uri.join(rel, this.base);
    return this;
}

$rdf.Variable.prototype.termType = 'variable';
$rdf.Variable.prototype.toNT = function() {
    if (this.uri.slice(0, this.base.length) == this.base) {
	return '?'+ this.uri.slice(this.base.length);} // @@ poor man's refTo
    return '?' + this.uri;
};

$rdf.Variable.prototype.toString = $rdf.Variable.prototype.toNT;
$rdf.Variable.prototype.classOrder = 7;

$rdf.variable = $rdf.Formula.prototype.variable = function(name) {
    return new $rdf.Variable(name);
};

$rdf.Variable.prototype.hashString = $rdf.Variable.prototype.toNT;


// The namespace function generator 

$rdf.Namespace = function (nsuri) {
    return function(ln) { return new $rdf.Symbol(nsuri+(ln===undefined?'':ln)) }
}

$rdf.Formula.prototype.ns = function(nsuri) {
    return function(ln) { return new $rdf.Symbol(nsuri+(ln===undefined?'':ln)) }
}


// Parse a single token
//
// The bnode bit should not be used on program-external values; designed
// for internal work such as storing a bnode id in an HTML attribute.
// This will only parse the strings generated by the vaious toNT() methods.

$rdf.Formula.prototype.fromNT = function(str) {
    var len = str.length
    var ch = str.slice(0,1)
    if (ch == '<') return $rdf.sym(str.slice(1,len-1))
    if (ch == '"') {
        var lang = undefined;
        var dt = undefined;
        var k = str.lastIndexOf('"');
        if (k < len-1) {
            if (str[k+1] == '@') lang = str.slice(k+2,len);
            else if (str.slice(k+1,k+3) == '^^') dt = $rdf.fromNT(str.slice(k+3,len));
            else throw "Can't convert string from NT: "+str
        }
        var str = (str.slice(1,k));
        str = str.replace(/\\"/g, '"');    // unescape quotes '
        str = str.replace(/\\n/g, '\n');    // unescape newlines
        str = str.replace(/\\\\/g, '\\');  // unescape backslashes 
        return $rdf.lit(str, lang, dt);
    }
    if (ch == '_') {
	var x = new $rdf.BlankNode();
	x.id = parseInt(str.slice(3));
	$rdf.NextId--
	return x
    }
    if (ch == '?') {
        var x = new $rdf.Variable(str.slice(1));
        return x;
    }
    throw "Can't convert from NT: "+str;
    
}
$rdf.fromNT = $rdf.Formula.prototype.fromNT; // Not for inexpert user

// Convenience - and more conventional name:

$rdf.graph = function(){return new $rdf.IndexedFormula();};

// ends
/**
 * @fileoverview
 * TABULATOR RDF PARSER
 *
 * Version 0.1
 *  Parser believed to be in full positive RDF/XML parsing compliance
 *  with the possible exception of handling deprecated RDF attributes
 *  appropriately. Parser is believed to comply fully with other W3C
 *  and industry standards where appropriate (DOM, ECMAScript, &c.)
 *
 *  Author: David Sheets <dsheets@mit.edu>
 *  SVN ID: $Id$
 *
 * W3C® SOFTWARE NOTICE AND LICENSE
 * http://www.w3.org/Consortium/Legal/2002/copyright-software-20021231
 * This work (and included software, documentation such as READMEs, or
 * other related items) is being provided by the copyright holders under
 * the following license. By obtaining, using and/or copying this work,
 * you (the licensee) agree that you have read, understood, and will
 * comply with the following terms and conditions.
 * 
 * Permission to copy, modify, and distribute this software and its
 * documentation, with or without modification, for any purpose and
 * without fee or royalty is hereby granted, provided that you include
 * the following on ALL copies of the software and documentation or
 * portions thereof, including modifications:
 * 
 * 1. The full text of this NOTICE in a location viewable to users of
 * the redistributed or derivative work.
 * 2. Any pre-existing intellectual property disclaimers, notices, or terms and
 * conditions. If none exist, the W3C Software Short Notice should be
 * included (hypertext is preferred, text is permitted) within the body
 * of any redistributed or derivative code.
 * 3. Notice of any changes or modifications to the files, including the
 * date changes were made. (We recommend you provide URIs to the location
 * from which the code is derived.)
 * 
 * THIS SOFTWARE AND DOCUMENTATION IS PROVIDED "AS IS," AND COPYRIGHT
 * HOLDERS MAKE NO REPRESENTATIONS OR WARRANTIES, EXPRESS OR IMPLIED,
 * INCLUDING BUT NOT LIMITED TO, WARRANTIES OF MERCHANTABILITY OR FITNESS
 * FOR ANY PARTICULAR PURPOSE OR THAT THE USE OF THE SOFTWARE OR
 * DOCUMENTATION WILL NOT INFRINGE ANY THIRD PARTY PATENTS, COPYRIGHTS,
 * TRADEMARKS OR OTHER RIGHTS.
 * 
 * COPYRIGHT HOLDERS WILL NOT BE LIABLE FOR ANY DIRECT, INDIRECT, SPECIAL
 * OR CONSEQUENTIAL DAMAGES ARISING OUT OF ANY USE OF THE SOFTWARE OR
 * DOCUMENTATION.
 * 
 * The name and trademarks of copyright holders may NOT be used in
 * advertising or publicity pertaining to the software without specific,
 * written prior permission. Title to copyright in this software and any
 * associated documentation will at all times remain with copyright
 * holders.
 */
/**
 * @class Class defining an RDFParser resource object tied to an RDFStore
 *  
 * @author David Sheets <dsheets@mit.edu>
 * @version 0.1
 * 
 * @constructor
 * @param {RDFStore} store An RDFStore object
 */
$rdf.RDFParser = function (store) {
    var RDFParser = {};

    /** Standard namespaces that we know how to handle @final
     *  @member RDFParser
     */
    RDFParser['ns'] = {'RDF':
		       "http://www.w3.org/1999/02/22-rdf-syntax-ns#",
		       'RDFS':
		       "http://www.w3.org/2000/01/rdf-schema#"}
    /** DOM Level 2 node type magic numbers @final
     *  @member RDFParser
     */
    RDFParser['nodeType'] = {'ELEMENT': 1, 'ATTRIBUTE': 2, 'TEXT': 3,
			     'CDATA_SECTION': 4, 'ENTITY_REFERENCE': 5,
			     'ENTITY': 6, 'PROCESSING_INSTRUCTION': 7,
			     'COMMENT': 8, 'DOCUMENT': 9, 'DOCUMENT_TYPE': 10,
			     'DOCUMENT_FRAGMENT': 11, 'NOTATION': 12}

    /**
     * Frame class for namespace and base URI lookups
     * Base lookups will always resolve because the parser knows
     * the default base.
     *
     * @private
     */
    this['frameFactory'] = function (parser, parent, element) {
	return {'NODE': 1,
		'ARC': 2,
		'parent': parent,
		'parser': parser,
		'store': parser['store'],
		'element': element,
		'lastChild': 0,
		'base': null,
		'lang': null,
		'node': null,
		'nodeType': null,
		'listIndex': 1,
		'rdfid': null,
		'datatype': null,
		'collection': false,

	/** Terminate the frame and notify the store that we're done */
		'terminateFrame': function () {
		    if (this['collection']) {
			this['node']['close']()
		    }
		},
	
	/** Add a symbol of a certain type to the this frame */
		'addSymbol': function (type, uri) {
		    uri = $rdf.Util.uri.join(uri, this['base'])
		    this['node'] = this['store']['sym'](uri)
		    this['nodeType'] = type
		},
	
	/** Load any constructed triples into the store */
		'loadTriple': function () {
		    if (this['parent']['parent']['collection']) {
			this['parent']['parent']['node']['append'](this['node'])
		    }
		    else {
			this['store']['add'](this['parent']['parent']['node'],
				       this['parent']['node'],
				       this['node'],
				       this['parser']['why'])
		    }
		    if (this['parent']['rdfid'] != null) { // reify
			var triple = this['store']['sym'](
			    $rdf.Util.uri.join("#"+this['parent']['rdfid'],
					  this['base']))
			this['store']['add'](triple,
					     this['store']['sym'](
						 RDFParser['ns']['RDF']
						     +"type"),
					     this['store']['sym'](
						 RDFParser['ns']['RDF']
						     +"Statement"),
					     this['parser']['why'])
			this['store']['add'](triple,
					     this['store']['sym'](
						 RDFParser['ns']['RDF']
						     +"subject"),
					     this['parent']['parent']['node'],
					     this['parser']['why'])
			this['store']['add'](triple,
					     this['store']['sym'](
						 RDFParser['ns']['RDF']
						     +"predicate"),
					     this['parent']['node'],
					     this['parser']['why'])
			this['store']['add'](triple,
					     this['store']['sym'](
						 RDFParser['ns']['RDF']
						     +"object"),
					     this['node'],
					     this['parser']['why'])
		    }
		},

	/** Check if it's OK to load a triple */
		'isTripleToLoad': function () {
		    return (this['parent'] != null
			    && this['parent']['parent'] != null
			    && this['nodeType'] == this['NODE']
			    && this['parent']['nodeType'] == this['ARC']
			    && this['parent']['parent']['nodeType']
			    == this['NODE'])
		},

	/** Add a symbolic node to this frame */
		'addNode': function (uri) {
		    this['addSymbol'](this['NODE'],uri)
		    if (this['isTripleToLoad']()) {
			this['loadTriple']()
		    }
		},

	/** Add a collection node to this frame */
		'addCollection': function () {
		    this['nodeType'] = this['NODE']
		    this['node'] = this['store']['collection']()
		    this['collection'] = true
		    if (this['isTripleToLoad']()) {
			this['loadTriple']()
		    }
		},

	/** Add a collection arc to this frame */
		'addCollectionArc': function () {
		    this['nodeType'] = this['ARC']
		},

	/** Add a bnode to this frame */
		'addBNode': function (id) {
		    if (id != null) {
			if (this['parser']['bnodes'][id] != null) {
			    this['node'] = this['parser']['bnodes'][id]
			} else {
			    this['node'] = this['parser']['bnodes'][id] = this['store']['bnode']()
			}
		    } else { this['node'] = this['store']['bnode']() }
		    
		    this['nodeType'] = this['NODE']
		    if (this['isTripleToLoad']()) {
			this['loadTriple']()
		    }
		},

	/** Add an arc or property to this frame */
		'addArc': function (uri) {
		    if (uri == RDFParser['ns']['RDF']+"li") {
			uri = RDFParser['ns']['RDF']+"_"+this['parent']['listIndex']++
		    }
		    this['addSymbol'](this['ARC'], uri)
		},

	/** Add a literal to this frame */
		'addLiteral': function (value) {
		    if (this['parent']['datatype']) {
			this['node'] = this['store']['literal'](
			    value, "", this['store']['sym'](
				this['parent']['datatype']))
		    }
		    else {
			this['node'] = this['store']['literal'](
			    value, this['lang'])
		    }
		    this['nodeType'] = this['NODE']
		    if (this['isTripleToLoad']()) {
			this['loadTriple']()
		    }
		}
	       }
    }

    //from the OpenLayers source .. needed to get around IE problems.
    this['getAttributeNodeNS'] = function(node, uri, name) {
        var attributeNode = null;
        if(node.getAttributeNodeNS) {
            attributeNode = node.getAttributeNodeNS(uri, name);
        } else {
            var attributes = node.attributes;
            var potentialNode, fullName;
            for(var i=0; i<attributes.length; ++i) {
                potentialNode = attributes[i];
                if(potentialNode.namespaceURI == uri) {
                    fullName = (potentialNode.prefix) ?
                               (potentialNode.prefix + ":" + name) : name;
                    if(fullName == potentialNode.nodeName) {
                        attributeNode = potentialNode;
                        break;
                    }
                }
            }
        }
        return attributeNode;
    }

    /** Our triple store reference @private */
    this['store'] = store
    /** Our identified blank nodes @private */
    this['bnodes'] = {}
    /** A context for context-aware stores @private */
    this['why'] = null
    /** Reification flag */
    this['reify'] = false

    /**
     * Build our initial scope frame and parse the DOM into triples
     * @param {DOMTree} document The DOM to parse
     * @param {String} base The base URL to use 
     * @param {Object} why The context to which this resource belongs
     */
    this['parse'] = function (document, base, why) {
        // alert('parse base:'+base);
	var children = document['childNodes']

	// clean up for the next run
	this['cleanParser']()

	// figure out the root element
	//var root = document.documentElement; //this is faster, I think, cross-browser issue? well, DOM 2
	if (document['nodeType'] == RDFParser['nodeType']['DOCUMENT']) {
	    for (var c=0; c<children['length']; c++) {
		if (children[c]['nodeType']
		    == RDFParser['nodeType']['ELEMENT']) {
		    var root = children[c]
		    break
		}
	    }	    
	}
	else if (document['nodeType'] == RDFParser['nodeType']['ELEMENT']) {
	    var root = document
	}
	else {
	    throw new Error("RDFParser: can't find root in " + base
			    + ". Halting. ")
	    return false
	}
	
	this['why'] = why
        

	// our topmost frame

	var f = this['frameFactory'](this)
        this['base'] = base
	f['base'] = base
	f['lang'] = ''
	
	this['parseDOM'](this['buildFrame'](f,root))
	return true
    }
    this['parseDOM'] = function (frame) {
	// a DOM utility function used in parsing
	var elementURI = function (el) {
        var result = "";
            if (el['namespaceURI'] == null) {
                throw new Error("RDF/XML syntax error: No namespace for "
                            +el['localName']+" in "+this.base)
            }
        if( el['namespaceURI'] ) {
            result = result + el['namespaceURI'];
        }
        if( el['localName'] ) {
            result = result + el['localName'];
        } else if( el['nodeName'] ) {
            if(el['nodeName'].indexOf(":")>=0)
                result = result + el['nodeName'].split(":")[1];
            else
                result = result + el['nodeName'];
        }
	    return result;
	}
	var dig = true // if we'll dig down in the tree on the next iter

	while (frame['parent']) {
	    var dom = frame['element']
	    var attrs = dom['attributes']

	    if (dom['nodeType']
		== RDFParser['nodeType']['TEXT']
		|| dom['nodeType']
		== RDFParser['nodeType']['CDATA_SECTION']) {//we have a literal
		frame['addLiteral'](dom['nodeValue'])
	    }
	    else if (elementURI(dom)
		     != RDFParser['ns']['RDF']+"RDF") { // not root
		if (frame['parent'] && frame['parent']['collection']) {
		    // we're a collection element
		    frame['addCollectionArc']()
		    frame = this['buildFrame'](frame,frame['element'])
		    frame['parent']['element'] = null
		}
                if (!frame['parent'] || !frame['parent']['nodeType']
		    || frame['parent']['nodeType'] == frame['ARC']) {
		    // we need a node
            var about =this['getAttributeNodeNS'](dom,
			RDFParser['ns']['RDF'],"about")
		    var rdfid =this['getAttributeNodeNS'](dom,
			RDFParser['ns']['RDF'],"ID")
		    if (about && rdfid) {
			throw new Error("RDFParser: " + dom['nodeName']
					+ " has both rdf:id and rdf:about."
					+ " Halting. Only one of these"
					+ " properties may be specified on a"
					+ " node.");
		    }
		    if (about == null && rdfid) {
			frame['addNode']("#"+rdfid['nodeValue'])
			dom['removeAttributeNode'](rdfid)
		    }
		    else if (about == null && rdfid == null) {
                var bnid = this['getAttributeNodeNS'](dom,
			    RDFParser['ns']['RDF'],"nodeID")
			if (bnid) {
			    frame['addBNode'](bnid['nodeValue'])
			    dom['removeAttributeNode'](bnid)
			} else { frame['addBNode']() }
		    }
		    else {
			frame['addNode'](about['nodeValue'])
			dom['removeAttributeNode'](about)
		    }
		
		    // Typed nodes
		    var rdftype = this['getAttributeNodeNS'](dom,
			RDFParser['ns']['RDF'],"type")
		    if (RDFParser['ns']['RDF']+"Description"
			!= elementURI(dom)) {
			rdftype = {'nodeValue': elementURI(dom)}
		    }
		    if (rdftype != null) {
			this['store']['add'](frame['node'],
					     this['store']['sym'](
						 RDFParser['ns']['RDF']+"type"),
					     this['store']['sym'](
						 $rdf.Util.uri.join(
						     rdftype['nodeValue'],
						     frame['base'])),
					     this['why'])
			if (rdftype['nodeName']){
			    dom['removeAttributeNode'](rdftype)
			}
		    }
		    
		    // Property Attributes
		    for (var x = attrs['length']-1; x >= 0; x--) {
			this['store']['add'](frame['node'],
					     this['store']['sym'](
						 elementURI(attrs[x])),
					     this['store']['literal'](
						 attrs[x]['nodeValue'],
						 frame['lang']),
					     this['why'])
		    }
		}
		else { // we should add an arc (or implicit bnode+arc)
		    frame['addArc'](elementURI(dom))

		    // save the arc's rdf:ID if it has one
		    if (this['reify']) {
            var rdfid = this['getAttributeNodeNS'](dom,
			    RDFParser['ns']['RDF'],"ID")
			if (rdfid) {
			    frame['rdfid'] = rdfid['nodeValue']
			    dom['removeAttributeNode'](rdfid)
			}
		    }

		    var parsetype = this['getAttributeNodeNS'](dom,
			RDFParser['ns']['RDF'],"parseType")
		    var datatype = this['getAttributeNodeNS'](dom,
			RDFParser['ns']['RDF'],"datatype")
		    if (datatype) {
			frame['datatype'] = datatype['nodeValue']
			dom['removeAttributeNode'](datatype)
		    }

		    if (parsetype) {
			var nv = parsetype['nodeValue']
			if (nv == "Literal") {
			    frame['datatype']
				= RDFParser['ns']['RDF']+"XMLLiteral"
			    // (this.buildFrame(frame)).addLiteral(dom)
			    // should work but doesn't
			    frame = this['buildFrame'](frame)
			    frame['addLiteral'](dom)
			    dig = false
			}
			else if (nv == "Resource") {
			    frame = this['buildFrame'](frame,frame['element'])
			    frame['parent']['element'] = null
			    frame['addBNode']()
			}
			else if (nv == "Collection") {
			    frame = this['buildFrame'](frame,frame['element'])
			    frame['parent']['element'] = null
			    frame['addCollection']()
			}
			dom['removeAttributeNode'](parsetype)
		    }

		    if (attrs['length'] != 0) {
            var resource = this['getAttributeNodeNS'](dom,
			    RDFParser['ns']['RDF'],"resource")
			var bnid = this['getAttributeNodeNS'](dom,
			    RDFParser['ns']['RDF'],"nodeID")

			frame = this['buildFrame'](frame)
			if (resource) {
			    frame['addNode'](resource['nodeValue'])
			    dom['removeAttributeNode'](resource)
			} else {
			    if (bnid) {
				frame['addBNode'](bnid['nodeValue'])
				dom['removeAttributeNode'](bnid)
			    } else { frame['addBNode']() }
			}

			for (var x = attrs['length']-1; x >= 0; x--) {
			    var f = this['buildFrame'](frame)
			    f['addArc'](elementURI(attrs[x]))
			    if (elementURI(attrs[x])
				==RDFParser['ns']['RDF']+"type"){
				(this['buildFrame'](f))['addNode'](
				    attrs[x]['nodeValue'])
			    } else {
				(this['buildFrame'](f))['addLiteral'](
				    attrs[x]['nodeValue'])
			    }
			}
		    }
		    else if (dom['childNodes']['length'] == 0) {
			(this['buildFrame'](frame))['addLiteral']("")
		    }
		}
	    } // rdf:RDF

	    // dig dug
	    dom = frame['element']
	    while (frame['parent']) {
		var pframe = frame
		while (dom == null) {
		    frame = frame['parent']
		    dom = frame['element']
		}
		var candidate = dom['childNodes'][frame['lastChild']]
		if (candidate == null || !dig) {
		    frame['terminateFrame']()
		    if (!(frame = frame['parent'])) { break } // done
		    dom = frame['element']
		    dig = true
		}
		else if ((candidate['nodeType']
			  != RDFParser['nodeType']['ELEMENT']
			  && candidate['nodeType']
			  != RDFParser['nodeType']['TEXT']
			  && candidate['nodeType']
			  != RDFParser['nodeType']['CDATA_SECTION'])
			 || ((candidate['nodeType']
			      == RDFParser['nodeType']['TEXT']
			      || candidate['nodeType']
			      == RDFParser['nodeType']['CDATA_SECTION'])
			     && dom['childNodes']['length'] != 1)) {
		    frame['lastChild']++
		}
		else { // not a leaf
		    frame['lastChild']++
		    frame = this['buildFrame'](pframe,
					       dom['childNodes'][frame['lastChild']-1])
		    break
		}
	    }
	} // while
    }

    /**
     * Cleans out state from a previous parse run
     * @private
     */
    this['cleanParser'] = function () {
	this['bnodes'] = {}
	this['why'] = null
    }

    /**
     * Builds scope frame 
     * @private
     */
    this['buildFrame'] = function (parent, element) {
	var frame = this['frameFactory'](this,parent,element)
	if (parent) {
	    frame['base'] = parent['base']
	    frame['lang'] = parent['lang']
	}
	if (element == null
	    || element['nodeType'] == RDFParser['nodeType']['TEXT']
	    || element['nodeType'] == RDFParser['nodeType']['CDATA_SECTION']) {
	    return frame
	}

	var attrs = element['attributes']

	var base = element['getAttributeNode']("xml:base")
	if (base != null) {
	    frame['base'] = base['nodeValue']
	    element['removeAttribute']("xml:base")
	}
	var lang = element['getAttributeNode']("xml:lang")
	if (lang != null) {
	    frame['lang'] = lang['nodeValue']
	    element['removeAttribute']("xml:lang")
	}

	// remove all extraneous xml and xmlns attributes
	for (var x = attrs['length']-1; x >= 0; x--) {
	    if (attrs[x]['nodeName']['substr'](0,3) == "xml") {
                if (attrs[x].name.slice(0,6)=='xmlns:') {
                    var uri = attrs[x].nodeValue;
                    // alert('base for namespac attr:'+this.base);
                    if (this.base) uri = $rdf.Util.uri.join(uri, this.base);
                    this.store.setPrefixForURI(attrs[x].name.slice(6),
                                                uri);
                }
//		alert('rdfparser: xml atribute: '+attrs[x].name) //@@
		element['removeAttributeNode'](attrs[x])
	    }
	}
	return frame
    }
}
//  Identity management and indexing for RDF
//
// This file provides  IndexedFormula a formula (set of triples) which
// indexed by predicate, subject and object.
//
// It "smushes"  (merges into a single node) things which are identical 
// according to owl:sameAs or an owl:InverseFunctionalProperty
// or an owl:FunctionalProperty
//
//
//  2005-10 Written Tim Berners-Lee
//  2007    Changed so as not to munge statements from documents when smushing
//
// 

/*jsl:option explicit*/ // Turn on JavaScriptLint variable declaration checking

$rdf.IndexedFormula = function() {

var owl_ns = "http://www.w3.org/2002/07/owl#";
// var link_ns = "http://www.w3.org/2007/ont/link#";

/* hashString functions are used as array indeces. This is done to avoid
** conflict with existing properties of arrays such as length and map.
** See issue 139.
*/
$rdf.Literal.prototype.hashString = $rdf.Literal.prototype.toNT;
$rdf.Symbol.prototype.hashString = $rdf.Symbol.prototype.toNT;
$rdf.BlankNode.prototype.hashString = $rdf.BlankNode.prototype.toNT;
$rdf.Collection.prototype.hashString = $rdf.Collection.prototype.toNT;


//Stores an associative array that maps URIs to functions
$rdf.IndexedFormula = function(features) {
    this.statements = [];    // As in Formula
    this.optional = [];
    this.propertyActions = []; // Array of functions to call when getting statement with {s X o}
    //maps <uri> to [f(F,s,p,o),...]
    this.classActions = [];   // Array of functions to call when adding { s type X }
    this.redirections = [];   // redirect to lexically smaller equivalent symbol
    this.aliases = [];   // reverse mapping to redirection: aliases for this
    this.HTTPRedirects = []; // redirections we got from HTTP
    this.subjectIndex = [];  // Array of statements with this X as subject
    this.predicateIndex = [];  // Array of statements with this X as subject
    this.objectIndex = [];  // Array of statements with this X as object
    this.whyIndex = [];     // Array of statements with X as provenance
    this.index = [ this.subjectIndex, this.predicateIndex, this.objectIndex, this.whyIndex ];
    this.namespaces = {} // Dictionary of namespace prefixes
    if (features === undefined) features = ["sameAs",
                    "InverseFunctionalProperty", "FunctionalProperty"];
//    this.features = features
    // Callbackify?
    function handleRDFType(formula, subj, pred, obj, why) {
        if (formula.typeCallback != undefined)
            formula.typeCallback(formula, obj, why);

        var x = formula.classActions[obj.hashString()];
        var done = false;
        if (x) {
            for (var i=0; i<x.length; i++) {                
                done = done || x[i](formula, subj, pred, obj, why);
            }
        }
        return done; // statement given is not needed if true
    } //handleRDFType

    //If the predicate is #type, use handleRDFType to create a typeCallback on the object
    this.propertyActions[
	'<http://www.w3.org/1999/02/22-rdf-syntax-ns#type>'] = [ handleRDFType ];

    // Assumption: these terms are not redirected @@fixme
    if ($rdf.Util.ArrayIndexOf(features,"sameAs") >= 0)
        this.propertyActions['<http://www.w3.org/2002/07/owl#sameAs>'] = [
	function(formula, subj, pred, obj, why) {
            // tabulator.log.warn("Equating "+subj.uri+" sameAs "+obj.uri);  //@@
            formula.equate(subj,obj);
            return true; // true if statement given is NOT needed in the store
	}]; //sameAs -> equate & don't add to index

    if ($rdf.Util.ArrayIndexOf(features,"InverseFunctionalProperty") >= 0)
        this.classActions["<"+owl_ns+"InverseFunctionalProperty>"] = [
            function(formula, subj, pred, obj, addFn) {
                return formula.newPropertyAction(subj, handle_IFP); // yes subj not pred!
            }]; //IFP -> handle_IFP, do add to index

    if ($rdf.Util.ArrayIndexOf(features,"FunctionalProperty") >= 0)
        this.classActions["<"+owl_ns+"FunctionalProperty>"] = [
            function(formula, subj, proj, obj, addFn) {
                return formula.newPropertyAction(subj, handle_FP);
            }]; //FP => handleFP, do add to index

    function handle_IFP(formula, subj, pred, obj)  {
        var s1 = formula.any(undefined, pred, obj);
        if (s1 == undefined) return false; // First time with this value
        // tabulator.log.warn("Equating "+s1.uri+" and "+subj.uri + " because IFP "+pred.uri);  //@@
        formula.equate(s1, subj);
        return true;
    } //handle_IFP

    function handle_FP(formula, subj, pred, obj)  {
        var o1 = formula.any(subj, pred, undefined);
        if (o1 == undefined) return false; // First time with this value
        // tabulator.log.warn("Equating "+o1.uri+" and "+obj.uri + " because FP "+pred.uri);  //@@
        formula.equate(o1, obj);
        return true ;
    } //handle_FP

} /* end IndexedFormula */

$rdf.IndexedFormula.prototype = new $rdf.Formula();
$rdf.IndexedFormula.prototype.constructor = $rdf.IndexedFormula;
$rdf.IndexedFormula.SuperClass = $rdf.Formula;

$rdf.IndexedFormula.prototype.newPropertyAction = function newPropertyAction(pred, action) {
    //$rdf.log.debug("newPropertyAction:  "+pred);
    var hash = pred.hashString();
    if (this.propertyActions[hash] == undefined)
        this.propertyActions[hash] = [];
    this.propertyActions[hash].push(action);
    // Now apply the function to to statements already in the store
    var toBeFixed = this.statementsMatching(undefined, pred, undefined);
    done = false;
    for (var i=0; i<toBeFixed.length; i++) { // NOT optimized - sort toBeFixed etc
        done = done || action(this, toBeFixed[i].subject, pred, toBeFixed[i].object);
    }
    return done;
}

$rdf.IndexedFormula.prototype.setPrefixForURI = function(prefix, nsuri) {
    //TODO:This is a hack for our own issues, which ought to be fixed post-release
    //See http://dig.csail.mit.edu/cgi-bin/roundup.cgi/$rdf/issue227
    if(prefix=="tab" && this.namespaces["tab"]) {
        return;
    }
    this.namespaces[prefix] = nsuri
}

// Deprocated ... name too generic
$rdf.IndexedFormula.prototype.register = function(prefix, nsuri) {
    this.namespaces[prefix] = nsuri
}


/** simplify graph in store when we realize two identifiers are equivalent

We replace the bigger with the smaller.

*/
$rdf.IndexedFormula.prototype.equate = function(u1, u2) {
    // tabulator.log.warn("Equating "+u1+" and "+u2); // @@
    //@@JAMBO Must canonicalize the uris to prevent errors from a=b=c
    //03-21-2010
    u1 = this.canon( u1 );
    u2 = this.canon( u2 );
    var d = u1.compareTerm(u2);
    if (!d) return true; // No information in {a = a}
    var big, small;
    if (d < 0)  {  // u1 less than u2
	    return this.replaceWith(u2, u1);
    } else {
	    return this.replaceWith(u1, u2);
    }
}

// Replace big with small, obsoleted with obsoleting.
//
$rdf.IndexedFormula.prototype.replaceWith = function(big, small) {
    //$rdf.log.debug("Replacing "+big+" with "+small) // @@
    var oldhash = big.hashString();
    var newhash = small.hashString();

    var moveIndex = function(ix) {
        var oldlist = ix[oldhash];
        if (oldlist == undefined) return; // none to move
        var newlist = ix[newhash];
        if (newlist == undefined) {
            ix[newhash] = oldlist;
        } else {
            ix[newhash] = oldlist.concat(newlist);
        }
        delete ix[oldhash];    
    }
    
    // the canonical one carries all the indexes
    for (var i=0; i<4; i++) {
        moveIndex(this.index[i]);
    }

    this.redirections[oldhash] = small;
    if (big.uri) {
        //@@JAMBO: must update redirections,aliases from sub-items, too.
	    if (this.aliases[newhash] == undefined)
	        this.aliases[newhash] = [];
	    this.aliases[newhash].push(big); // Back link
        
        if( this.aliases[oldhash] ) {
            for( var i = 0; i < this.aliases[oldhash].length; i++ ) {
                this.redirections[this.aliases[oldhash][i].hashString()] = small;
                this.aliases[newhash].push(this.aliases[oldhash][i]);
            }            
        }
        
	    this.add(small, this.sym('http://www.w3.org/2007/ont/link#uri'), big.uri)
        
	    // If two things are equal, and one is requested, we should request the other.
	    if (this.sf) {
	        this.sf.nowKnownAs(big, small)
	    }    
    }
    
    moveIndex(this.classActions);
    moveIndex(this.propertyActions);

    //$rdf.log.debug("Equate done. "+big+" to be known as "+small)    
    return true;  // true means the statement does not need to be put in
};

// Return the symbol with canonical URI as smushed
$rdf.IndexedFormula.prototype.canon = function(term) {
    if (term == undefined) return term;
    var y = this.redirections[term.hashString()];
    if (y == undefined) return term;
    return y;
}

// Compare by canonical URI as smushed
$rdf.IndexedFormula.prototype.sameThings = function(x, y) {
    if (x.sameTerm(y)) return true;
    var x1 = this.canon(x);
//    alert('x1='+x1);
    if (x1 == undefined) return false;
    var y1 = this.canon(y);
//    alert('y1='+y1); //@@
    if (y1 == undefined) return false;
    return (x1.uri == y1.uri);
}

// A list of all the URIs by which this thing is known
$rdf.IndexedFormula.prototype.uris = function(term) {
    var cterm = this.canon(term)
    var terms = this.aliases[cterm.hashString()];
    if (!cterm.uri) return []
    var res = [ cterm.uri ]
    if (terms != undefined) {
	for (var i=0; i<terms.length; i++) {
	    res.push(terms[i].uri)
	}
    }
    return res
}

// On input parameters, convert constants to terms
// 
function RDFMakeTerm(formula,val, canonicalize) {
    if (typeof val != 'object') {   
	    if (typeof val == 'string')
	        return new $rdf.Literal(val);
        if (typeof val == 'number')
            return new $rdf.Literal(val); // @@ differet types
        if (typeof val == 'boolean')
            return new $rdf.Literal(val?"1":"0", undefined, 
                                    $rdf.Symbol.prototype.XSDboolean);
	    else if (typeof val == 'number')
	        return new $rdf.Literal(''+val);   // @@ datatypes
	    else if (typeof val == 'undefined')
	        return undefined;
	    else    // @@ add converting of dates and numbers
	        throw "Can't make Term from " + val + " of type " + typeof val; 
    }
    return val;
}

// Add a triple to the store
//
//  Returns the statement added
// (would it be better to return the original formula for chaining?)
//
$rdf.IndexedFormula.prototype.add = function(subj, pred, obj, why) {
    var actions, st;
    if (why == undefined) why = this.fetcher ? this.fetcher.appNode: this.sym("chrome:theSession"); //system generated
                               //defined in source.js, is this OK with identity.js only user?
    subj = RDFMakeTerm(this, subj);
    pred = RDFMakeTerm(this, pred);
    obj = RDFMakeTerm(this, obj);
    why = RDFMakeTerm(this, why);
    
    var hash = [ this.canon(subj).hashString(), this.canon(pred).hashString(),
            this.canon(obj).hashString(), this.canon(why).hashString()];


    if (this.predicateCallback != undefined)
	this.predicateCallback(this, pred, why);
	
    // Action return true if the statement does not need to be added
    var actions = this.propertyActions[hash[1]]; // Predicate hash
    var done = false;
    if (actions) {
        // alert('type: '+typeof actions +' @@ actions='+actions);
        for (var i=0; i<actions.length; i++) {
            done = done || actions[i](this, subj, pred, obj, why);
        }
    }
    
    //If we are tracking provenanance, every thing should be loaded into the store
    //if (done) return new Statement(subj, pred, obj, why); // Don't put it in the store
                                                             // still return this statement for owl:sameAs input
    var st = new $rdf.Statement(subj, pred, obj, why);
    for (var i=0; i<4; i++) {
        var ix = this.index[i];
        var h = hash[i];
        if (ix[h] == undefined) ix[h] = [];
        ix[h].push(st); // Set of things with this as subject, etc
    }
    
    //$rdf.log.debug("ADDING    {"+subj+" "+pred+" "+obj+"} "+why);
    this.statements.push(st);
    return st;
}; //add


// Find out whether a given URI is used as symbol in the formula
$rdf.IndexedFormula.prototype.mentionsURI = function(uri) {
    var hash = '<' + uri + '>';
    return (!!this.subjectIndex[hash] || !!this.objectIndex[hash]
            || !!this.predicateIndex[hash]);
}

// Find an unused id for a file being edited: return a symbol
// (Note: Slow iff a lot of them -- could be O(log(k)) )
$rdf.IndexedFormula.prototype.nextSymbol = function(doc) {
    for(var i=0;;i++) {
        var uri = doc.uri + '#n' + i;
        if (!this.mentionsURI(uri)) return this.sym(uri);
    }
}


$rdf.IndexedFormula.prototype.anyStatementMatching = function(subj,pred,obj,why) {
    var x = this.statementsMatching(subj,pred,obj,why,true);
    if (!x || x == []) return undefined;
    return x[0];
};


// Return statements matching a pattern
// ALL CONVENIENCE LOOKUP FUNCTIONS RELY ON THIS!
$rdf.IndexedFormula.prototype.statementsMatching = function(subj,pred,obj,why,justOne) {
    //$rdf.log.debug("Matching {"+subj+" "+pred+" "+obj+"}");
    
    var pat = [ subj, pred, obj, why ];
    var pattern = [];
    var hash = [];
    var wild = []; // wildcards
    var given = []; // Not wild
    for (var p=0; p<4; p++) {
        pattern[p] = this.canon(RDFMakeTerm(this, pat[p]));
        if (pattern[p] == undefined) {
            wild.push(p);
        } else {
            given.push(p);
            hash[p] = pattern[p].hashString();
        }
    }
    if (given.length == 0) {
        return this.statements;
    }
    if (given.length == 1) {  // Easy too, we have an index for that
        var p = given[0];
        var list = this.index[p][hash[p]];
        if(list && justOne) {
            if(list.length>1)
                list = list.slice(0,1);
        }
        return list == undefined ? [] : list;
    }
    
    // Now given.length is 2, 3 or 4.
    // We hope that the scale-free nature of the data will mean we tend to get
    // a short index in there somewhere!
    
    var best = 1e10; // really bad
    var best_i;
    for (var i=0; i<given.length; i++) {
        var p = given[i]; // Which part we are dealing with
        var list = this.index[p][hash[p]];
        if (list == undefined) return []; // No occurrences
        if (list.length < best) {
            best = list.length;
            best_i = i;  // (not p!)
        }
    }
    
    // Ok, we have picked the shortest index but now we have to filter it
    var best_p = given[best_i];
    var possibles = this.index[best_p][hash[best_p]];
    var check = given.slice(0, best_i).concat(given.slice(best_i+1)) // remove best_i
    var results = [];
    var parts = [ 'subject', 'predicate', 'object', 'why'];
    for (var j=0; j<possibles.length; j++) {
        var st = possibles[j];
        for (var i=0; i <check.length; i++) { // for each position to be checked
            var p = check[i];
            if (!this.canon(st[parts[p]]).sameTerm(pattern[p])) {
                st = null; 
                break;
            }
        }
        if (st != null) results.push(st);
    }

    if(justOne) {
        if(results.length>1)
            results = results.slice(0,1);
    }
    return results;
}; // statementsMatching

/** remove a particular statement from the bank **/
$rdf.IndexedFormula.prototype.remove = function (st) {
    //$rdf.log.debug("entering remove w/ st=" + st);
    var term = [ st.subject, st.predicate, st.object, st.why];
    for (var p=0; p<4; p++) {
        var c = this.canon(term[p]);
        var h = c.hashString();
        if (this.index[p][h] == undefined) {
            //$rdf.log.warn ("Statement removal: no index '+p+': "+st);
        } else {
            $rdf.Util.RDFArrayRemove(this.index[p][h], st);
        }
    }
    $rdf.Util.RDFArrayRemove(this.statements, st);
}; //remove

/** remove all statements matching args (within limit) **/
$rdf.IndexedFormula.prototype.removeMany = function (subj, pred, obj, why, limit) {
    //$rdf.log.debug("entering removeMany w/ subj,pred,obj,why,limit = " + subj +", "+ pred+", " + obj+", " + why+", " + limit);
    var sts = this.statementsMatching (subj, pred, obj, why, false);
    //This is a subtle bug that occcured in updateCenter.js too.
    //The fact is, this.statementsMatching returns this.whyIndex instead of a copy of it
    //but for perfromance consideration, it's better to just do that
    //so make a copy here.
    var statements = [];
    for (var i=0;i<sts.length;i++) statements.push(sts[i]);
    if (limit) statements = statements.slice(0, limit);
    for (var i=0;i<statements.length;i++) this.remove(statements[i]);
}; //removeMany

/** Utility**/

/*  @method: copyTo
    @description: replace @template with @target and add appropriate triples (no triple removed)
                  one-direction replication 
*/ 
$rdf.IndexedFormula.prototype.copyTo = function(template,target,flags){
    if (!flags) flags=[];
    var statList=this.statementsMatching(template);
    if ($rdf.Util.ArrayIndexOf(flags,'two-direction')!=-1) 
        statList.concat(this.statementsMatching(undefined,undefined,template));
    for (var i=0;i<statList.length;i++){
        var st=statList[i];
        switch (st.object.termType){
            case 'symbol':
                this.add(target,st.predicate,st.object);
                break;
            case 'literal':
            case 'bnode':
            case 'collection':
                this.add(target,st.predicate,st.object.copy(this));
        }
        if ($rdf.Util.ArrayIndexOf(flags,'delete')!=-1) this.remove(st);
    }
};
//for the case when you alter this.value (text modified in userinput.js)
$rdf.Literal.prototype.copy = function(){ 
    return new $rdf.Literal(this.value,this.lang,this.datatype);
};
$rdf.BlankNode.prototype.copy = function(formula){ //depends on the formula
    var bnodeNew=new $rdf.BlankNode();
    formula.copyTo(this,bnodeNew);
    return bnodeNew;
}
/**  Full N3 bits  -- placeholders only to allow parsing, no functionality! **/

$rdf.IndexedFormula.prototype.newUniversal = function(uri) {
    var x = this.sym(uri);
    if (!this._universalVariables) this._universalVariables = [];
    this._universalVariables.push(x);
    return x;
}

$rdf.IndexedFormula.prototype.newExistential = function(uri) {
    if (!uri) return this.bnode();
    var x = this.sym(uri);
    return this.declareExistential(x);
}

$rdf.IndexedFormula.prototype.declareExistential = function(x) {
    if (!this._existentialVariables) this._existentialVariables = [];
    this._existentialVariables.push(x);
    return x;
}

$rdf.IndexedFormula.prototype.formula = function(features) {
    return new $rdf.IndexedFormula(features);
}

$rdf.IndexedFormula.prototype.close = function() {
    return this;
}

$rdf.IndexedFormula.prototype.hashString = $rdf.IndexedFormula.prototype.toNT;

return $rdf.IndexedFormula;

}();
// ends
/*!
 * File: visualizer.js
 * 
 * Copyright 2011  SURFfoundation
 * 
 * This file is part of InContext.
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *     http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * 
 * For more information: http://code.google.com/p/surf-incontext/
 */

/// <reference path="../framework/core.js"/>

(function ($) {
  // define Visualizer namespace in the global scope
  window.Visualizer = function () { }

  // Put the visualizer app into the global scope, so it can be initialized from outside
  window.VisualizerApp = function (canvasId, startObjectId, options, modules) {
    // Make sure the whole app can find the htmlId
    options["canvasId"] = canvasId;
    options["startObjectId"] = startObjectId;

    var core = new Visualizer.Core(options);
    var servicesReady = false;

    var useHistoryManager = core.getConfig("useHistoryManager");

    var defaultModules = {
      "historymanager": Visualizer.HistoryManager,
      "dataconnector": Visualizer.SyncDataConnector,
      "schemaconnector": Visualizer.SchemaConnector,
      "schemaservice": Visualizer.SchemaService,
      "dataservice": Visualizer.DataService,
      "navigationservice": Visualizer.NagivationService,
      "cloudservice": Visualizer.CloudService,
      "animationservice": Visualizer.AnimationService,
      "drawservice": Visualizer.HtmlDrawService
    }

    var modules = $.extend(defaultModules, modules);

    for (moduleID in modules) {
      core.register(moduleID, modules[moduleID]);
    }

    // Wait for application critical events to be fired
    var waitForEvents = ["document.ready", "core.all-modules-started", "schemaservice.ready"];
    //Also wait for the history manager (if used)
    if (useHistoryManager) {
      waitForEvents.push("historymanager.ready");
    }

    core.waitFor(waitForEvents, function (event) {
      var currentUrlId;

      //Url is already init with an id, take that ID if available
      //Else, take normal startObjectId
      if (event && event.data && event.data['historymanager.ready']) {
        currentUrlId = event.data['historymanager.ready'];
      }

      core.notify("VisualizerApp", "load-object", currentUrlId);
    }, this);

    // Make sure the DOM is loaded
    $(document).ready(function () { core.notify("document", "ready"); });

    // Start all modules
    core.startAll();

    return {

      subscribe: function (eventType, callback, sender) {
        core.subscribe("external", eventType, callback, sender);
      },

      unsubscribe: function (eventType, sender) {
        core.subscribe("external", eventType, sender);
      },

      //Do we want to be able to let externals call events?
      notify: function (eventType, data) {
        core.notify("external", eventType, data);
      },

      waitFor: function (eventTypes, callback, sender) {
        core.waitFor("external", eventTypes, sender);
      },

      stop: function () {
        core.stopAll();
      },

      loadObject: function (objectId) {
        core.notify("external", "object-click", objectId);
      },

      onObjectLoaded: function (callback, sender) {
        core.subscribe("external", "*.load-object-ready", function (objectId) {
          callback.call(sender, objectId);
        });
      }
    };
  };
})(jQuery);/*!
 * File: utils/htmlpopup.js
 * 
 * Copyright 2011  SURFfoundation
 * 
 * This file is part of InContext.
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *     http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * 
 * For more information: http://code.google.com/p/surf-incontext/
 */

(function ($) {
  Visualizer.HtmlPopup = function (container, openingElement, options) {

    var defaultOptions = {
      positionClass: 'top',
      closeButton: false,
      onClose: null,
      minWidth: 0,
      maxWidth: Infinity,
      minHeight: 0,
      maxHeight: Infinity
    };

    var settings = $.extend(defaultOptions, options);

    var canvas = container;
    var divPopup = null;
    var divContent = null;

    var _content = null;

    return {
      isOpen: false,

      setContent: function (content) {
        _content = content;
        if (divContent)
          divContent.html(_content);
      },

      open: function () {
        if (!divPopup) {
          this.draw();
        }

        divPopup.show();
        this.isOpen = true;
      },

      close: function () {
        this.isOpen = false;
        divPopup.hide();

        if (settings.onClose) {
          settings.onClose();
        }
      },

      destroy: function () {
        this.isOpen = false;
        this.close();

        divPopup.remove();
        divPopup = null;
      },

      draw: function () {
        divPopup = $('<div class="hover_popup" />');
        canvas.append(divPopup);
//        divPopup.css("overflow", "hidden");

        var divDirection = $('<div class="direction_hover_popup" />');
        divPopup.append(divDirection);

        var divBackground = $('<div class="bg_hover_popup" />');
        divPopup.append(divBackground);

        divContent = $('<div class="content_hover_popup"/>');
        divPopup.append(divContent);
        divContent.html(_content);

        if (settings.minWidth)
          divContent.css("min-width", settings.minWidth + "px");
        if (settings.maxWidth != Infinity)
          divContent.css("max-width", settings.maxWidth + "px");

        if (settings.closeButton) {
          var aClose = $('<a href="#" class="close_popup">X</a>');
          divPopup.append(aClose);

          var that = this;

          aClose.click(function (event) {
            event.preventDefault();

            that.close();
          });
        }

        // add position for arrow by classname
        divPopup.addClass(settings.positionClass);

        // define positions popup:
        var x = openingElement.offset().left - canvas.offset().left + (openingElement.width()/2)- (divPopup.width() / 2);
        var y = settings.positionClass == 'bottom' ? openingElement.offset().top - canvas.offset().top + (openingElement.height()+5) : openingElement.offset().top - canvas.offset().top - divPopup.height();

        // Change positions if left or right boundary is crossed
        if (x + divPopup.width() > canvas.width()) x = canvas.width() - divPopup.width();
        else if (x < 0) x = 10;

        if (settings.positionClass == 'bottom' && (y + divPopup.height() > canvas.offset().top + canvas.height())) {
          divPopup.removeClass('bottom');
          divPopup.addClass('top');
          y = openingElement.offset().top - canvas.offset().top - divPopup.height();
        } else if (settings.positionClass == 'top' && (y < canvas.offset().top)) {
          divPopup.removeClass('top');
          divPopup.addClass('bottom');
          y = openingElement.offset().top - canvas.offset().top + 20;
        }

        if (divPopup.height() > settings.maxHeight) {
          divContent.css({ "height": settings.maxHeight + "px", "overflow": "auto" });
        }

        // and... position popup
        divPopup.css({
          'left': x + 'px',
          'top': y + 'px'
        });

        // position arrow within popup:
        var dirx = openingElement.offset().left - divPopup.offset().left + 3;
        //if dirx has a negative value it means the arrow is gonna be placed outside the visible box so center it then:
        if(dirx<0) dirx = '50%';
        divDirection.css({
          'left': dirx
        });

        //set height+width for transparent background:
        divBackground.css({
          'height': (divPopup.height()),
          'width': (divPopup.width())
        });
      }
    }
  };
})(jQuery);/*!
 * File: utils/rdfxmlparser.js
 * 
 * Copyright 2011  SURFfoundation
 * 
 * This file is part of InContext.
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *     http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * 
 * For more information: http://code.google.com/p/surf-incontext/
 */

(function ($) {
  Visualizer.RdfXmlParser = function () {

    return {
      parse: function (dataUrl, callback) {
        var kb = new $rdf.IndexedFormula();

        $.ajax({
          url: dataUrl,
          dataType: ($.browser.msie) ? "text" : "xml",
          async: false,
          success: function(data) {
            var xml;
            if ($.browser.msie) {
              xml = new ActiveXObject("Microsoft.XMLDOM");
              xml.async = false;
              xml.loadXML(data);
            }
            else {
              xml = data;
            }

            var rdfxmlparser = new $rdf.RDFParser(kb);
            rdfxmlparser.reify = true;
            rdfxmlparser.parse(xml, '', '');
            
            var statements = kb.statements;
            
            var jsonData = {};
            for(var statementIdx = 0, statementCount = statements.length ; statementIdx < statementCount ; statementIdx++) {
              var statement = statements[statementIdx];
              var subject = statement.subject.value;
              var predicate = statement.predicate.value;
              
              if(jsonData[subject] == undefined) {
                jsonData[subject] = {};
              }
              var jsonDataPredicates = jsonData[subject];

              if(jsonData[subject][predicate] == undefined) {
                jsonData[subject][predicate] = [];
              }
              var jsonDataObjects = jsonData[subject][predicate];
              
              var jsonDataObject = {
                  value: statement.object.value
                };

              switch(statement.object.termType)
              {
                case 'literal':
                  jsonDataObject.type = 'literal';
                  break;
                case 'bnode':
                  jsonDataObject.type = 'bnode';
                  break;
                default:
                  jsonDataObject.type = 'uri';
              }

              if(jsonDataObject.lang) {
                jsonDataObject.lang = statement.object.lang;
              }
              
              jsonDataObjects.push(jsonDataObject);
            }
            callback(jsonData);
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
            alert("Failed to parse RDF/XML data: " + textStatus + " (" +  errorThrown +")");
          }
        });
      }
    }
  };
})(jQuery);/*
 * File: framework/core.js
 * 
 * Copyright 2011  SURFfoundation
 * 
 * This file is part of InContext.
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *     http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * 
 * For more information: http://code.google.com/p/surf-incontext/
 */

//http://www.wisecodes.com/2009/10/javascript-scalable-applications/
//http://www.slideshare.net/nzakas/scalable-javascript-application-architecture

(function ($) {
  Visualizer.Core = function (options) {
    // Private Variable
    var modules = {};
    
    var listeners = [];

    var waiters = [];

    //Default configuration values
    var defaults = {
      "maxWidth": 700,
      "debug": false,
      "dataUrl": '',
      "dataFormat": 'application/rdf+xml',
      "schemaUrl": '',
      "schemaFormat": 'application/rdf+xml',
      "idProperty": '',
      "titleProperties": [],
      "dontShowProperties": null,
      "inverseTypeId": "http:\/\/www.w3.org\/2002\/07\/owl#inverseOf",
      "symmetricTypeId": "http:\/\/www.w3.org\/2002\/07\/owl#SymmetricProperty",
      "imageTypeId": "",
      "annotationTypeId": "http://www.w3.org/1999/02/22-rdf-syntax-ns#Statement",
      "objectAnnotationTypeId": "http://www.w3.org/1999/02/22-rdf-syntax-ns#object",
      "subjectAnnotationTypeId": "http://www.w3.org/1999/02/22-rdf-syntax-ns#subject",
      "descriptionAnnotationTypeId": "http://purl.org/dc/terms/description",
      "useHistoryManager": true,
      "showProperties": true,
      "linkTarget": "_blank",
      "objectLinkTarget": "_blank",
      "concatCharacters" : " | ",
      "baseClassTypes": {
        // Default OWL base class
        "http:\/\/www.w3.org\/2002\/07\/owl#Thing": "thing",
        // Default supported ORE types
        "http:\/\/www.openarchives.org\/ore\/terms\/Aggregation": "aggregation",
        // Default supported Foaf types
        "http:\/\/xmlns.com\/foaf\/0.1\/Document": "document",
        "http:\/\/xmlns.com\/foaf\/0.1\/Image": "image",
        "http:\/\/xmlns.com\/foaf\/0.1\/Group": "group",
        "http:\/\/xmlns.com\/foaf\/0.1\/Organization": "organization",
        "http:\/\/xmlns.com\/foaf\/0.1\/Person": "person",
        "http:\/\/xmlns.com\/foaf\/0.1\/Project": "project",
        // Default supported w3 SKOS types
        "http:\/\/www.w3.org\/2004\/02\/skos\/core#Concept": "concept"
      }
    }

    //Merge default and supplied config values
    var options = $.extend(true, defaults, options);

    // Instance Creams
    function createInstance(core, moduleID) {
      return modules[moduleID].creator(moduleID, new Visualizer.Sandbox(moduleID, core));
    };

    function getEventRegex(eventType) {
      return new RegExp("^" + eventType.replace("*", "[^\.]*") + "$");
    };

    //  Public methods
    return {
      log: function (moduleID, message, data) {
        if (options["debug"] && window["console"] != null) {
          console.log(moduleID + ": " + message + " with data: ", data);
        }
      },
      getConfig: function (name) {
        return options[name];
      },
      setConfig: function (name, value) {
        options[name] = value;
      },
      getService: function (moduleID) {
        return modules[moduleID].instance;
      },
      register: function (moduleID, creator) {
        modules[moduleID] = {
          creator: creator,
          instance: null
        };
      },
      start: function (moduleID) {
        modules[moduleID].instance = createInstance(this, moduleID);
        if (modules[moduleID].instance.init)
          modules[moduleID].instance.init();

        this.notify("core", "module-started", moduleID);
      },
      stop: function (moduleID) {
        var data = modules[moduleID];
        if (data.instance) {
          if (data.instance.destroy)
            data.instance.destroy();
          data.instance = null;
        }

        this.notify("core", "module-stopped", moduleID);
      },
      startAll: function () {
        for (var moduleID in modules) {
          if (modules.hasOwnProperty(moduleID)) {
            this.start(moduleID);
          }
        }

        this.notify("core", "all-modules-started");
      },
      stopAll: function () {
        for (var moduleID in modules) {
          if (modules.hasOwnProperty(moduleID)) {
            this.stop(moduleID);
          }
        }

        this.notify("core", "all-modules-stopped");
      },
      //Accepts notify events from the sandbox and notify's subscribed modules
      notify: function (moduleID, eventType, data) {
        this.log(moduleID, "Event fired: " + moduleID + "." + eventType, data);

        for (var i = 0; i < listeners.length; i++) {
          var listener = listeners[i];
          if ((moduleID + "." + eventType).match(listener.regex)) {
            listener.callback.call(listener.obj, { type: eventType, data: data });
          }
        }

        for (var i = 0; i < waiters.length; i++) {
          var waiter = waiters[i];
          for (var regexKey = 0; regexKey < waiter.regexArray.length; regexKey++) {
            if ((moduleID + "." + eventType).match(waiter.regexArray[regexKey])) {
              waiter.regexArray.splice(regexKey, 1);
              waiter.data[moduleID + "." + eventType] = data;
            }
            if (waiter.regexArray.length == 0) {
              waiters.splice(i, 1);
              waiter.callback.call(waiter.obj, { data: waiter.data });
            }
          }
        }
      },
      //Wait for first occurrence of a combined set of events
      waitFor: function (eventTypes, callback, obj) {
        var regexArray = [];

        for (var key = 0; key < eventTypes.length; key++) {
          regexArray.push(getEventRegex(eventTypes[key]));
        }

        waiters.push({ regexArray: regexArray, callback: callback, obj: obj, data: [] });
      },
      //Start listening to events
      subscribe: function (moduleID, eventType, callback, obj) {
        var regex = getEventRegex(eventType);

        //Add to listeners array
        listeners.push({ eventType: eventType, regex: regex, callback: callback, obj: obj, moduleID: moduleID });
      },
      //Stop listening to a specific event
      unsubscribe: function (moduleID, eventType, sender) {
        //Unsubscribe
        for (var i = 0; i < listeners.length; i++) {
          var listener = listeners[i];
          if (listener.eventType == eventType && listener.moduleID == moduleID) {
            listeners.splice(i, 1);
          }
        }
      }
    };
  }
})(jQuery);/*
 * File: framework/sandbox.js
 * 
 * Copyright 2011  SURFfoundation
 * 
 * This file is part of InContext.
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *     http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * 
 * For more information: http://code.google.com/p/surf-incontext/
 */

(function ($) {
  Visualizer.Sandbox = function (moduleID, core) {
    return {
      //Get configuration setting from core
      getConfig: function (name) {
        return core.getConfig(name);
      },

      //Get reference to server registered at the core
      getService: function (moduleID) {
        return core.getService(moduleID);
      },

      //Log to the core
      log: function (message, data) {
        core.log(moduleID, message, data);
      },

      //Send notify event to subscribers
      notify: function (eventType, data) {
        core.notify(moduleID, eventType, data);
      },

      //Subscribe to event
      subscribe: function (eventType, callback, obj) {
        core.subscribe(moduleID, eventType, callback, obj);
      },

      //Unsubscribe from event
      unsubscribe: function (eventType) {
        core.unsubscribe(moduleID, eventType);
      },

      //Wait for multiple events
      waitFor: function (eventTypes, callback, obj) {
        core.waitFor(eventTypes, callback, obj);
      }
    }
  };
})(jQuery);/*
 * File: module/syncdataconnector.js
 * 
 * Copyright 2011  SURFfoundation
 * 
 * This file is part of InContext.
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *     http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * 
 * For more information: http://code.google.com/p/surf-incontext/
 */

(function ($) {

  // SyncDataConnector
  // Responsible for JSON requests for object data
  // Synchronous (whole dataset at once)
  Visualizer.SyncDataConnector = function (moduleID, sandbox) {
    // internal caching
    var jsonData;

    return {
      getData: function (id, callback) {
        //Is the data already in memory?
        if (jsonData) {
          callback(jsonData);
        }
        else {
          if (sandbox.getConfig("dataFormat") == 'application/json') {
            var url = sandbox.getConfig("dataUrl");

            //Get RDF/JSON data using web service
            $.getJSON(url, function (data) {
              jsonData = data;
              callback(jsonData);
            });
          }
          else if (sandbox.getConfig("dataFormat") == 'application/rdf+xml') {
            var url = sandbox.getConfig("dataUrl");
            
            var rdfXmlParser = new Visualizer.RdfXmlParser();
            
            //Get RDF/XML data using web service
            rdfXmlParser.parse(url, function (data) {
              jsonData = data;
              callback(jsonData);
            });
          }
          else {
            alert('Unsupported data format: ' + sandbox.getConfig("dataFormat"));
          }
        }
      }
    };
  };
})(jQuery);/*
 * File: module/schemaconnector.js
 * 
 * Copyright 2011  SURFfoundation
 * 
 * This file is part of InContext.
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *     http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * 
 * For more information: http://code.google.com/p/surf-incontext/
 */

(function ($) {
  //SchemaConnector
  //Responsible for JSON requests

  Visualizer.SchemaConnector = function (moduleID, sandbox) {
    var jsonSchema;

    return {
      init: function () {
        try {


        } catch (ex) {
          alert("sandbox not found");
        }
      },

      destroy: function () {
        //Destructor  

      },
      getSchema: function (callback) {
        //Is the data already in memory?
        if (jsonSchema) {
          callback(jsonSchema);
        }
        else {
          //Get RDF/JSON data using web service
          var url = sandbox.getConfig("schemaUrl");

          if (sandbox.getConfig("schemaFormat") == 'application/json') {
            var url = sandbox.getConfig("schemaUrl");

            //Get RDF/JSON data using web service
            $.getJSON(url, function (data) {
              jsonSchema = data;
              callback(jsonSchema);
            });
          }
          else if (sandbox.getConfig("schemaFormat") == 'application/rdf+xml') {
            var url = sandbox.getConfig("schemaUrl");
            
            var rdfXmlParser = new Visualizer.RdfXmlParser();
            
            //Get RDF/XML data using web service
            rdfXmlParser.parse(url, function (data) {
              jsonSchema = data;
              callback(jsonSchema);
            });
          }
          else {
            alert('Unsupported schema format: ' + sandbox.getConfig("schemaFormat"));
          }
        }
      }
    };
  };
})(jQuery);/*
 * File: module/dataservice.js
 * 
 * Copyright 2011  SURFfoundation
 * 
 * This file is part of InContext.
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *     http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * 
 * For more information: http://code.google.com/p/surf-incontext/
 */

/// <reference path="../domain/node.js"/>

(function ($) {

  //DataService
  //Responsible to map server data to usable domain objects
  Visualizer.DataService = function (moduleID, sandbox) {

    var AggregateTypeIdentifier = "http://www.openarchives.org/ore/terms/Aggregation";
    var TypePropertyIdentifier = "http://www.w3.org/1999/02/22-rdf-syntax-ns#type";
    var ObjectTypePropertyIdentifier = "http://www.w3.org/2002/07/owl#ObjectProperty";

    var BaseClassTypes = sandbox.getConfig("baseClassTypes");
    var DefaultBaseClassTypeId = "http://www.w3.org/2002/07/owl#Thing";

    //Get identifiers from configuration
    var TitlePropertyIdentifiers = sandbox.getConfig("titleProperties");
    var AnnotationTypeIdentifier = sandbox.getConfig("annotationTypeId");
    var ObjectAnnotationTypeIdentifier = sandbox.getConfig("objectAnnotationTypeId");
    var SubjectAnnotationTypeIdentifier = sandbox.getConfig("subjectAnnotationTypeId");
    var IdPropertyIdentifier = sandbox.getConfig("idProperty");
    var ConcatCharacters = sandbox.getConfig("concatCharacters");

    var dataConnector;
    var schemaService;

    var URI_IDENTIFIER = 'uri';
    var BNODE_IDENTIFIER = 'bnode';

    var objects = {};

    return {
      init: function () {
        dataConnector = sandbox.getService("dataconnector");
        schemaService = sandbox.getService("schemaservice");
      },

      //returns data from JSON service
      getData: function (id, callback) {
        dataConnector.getData(id, function (data) {
          callback(data);
        });
      },

      //Returns the center object, undefined is center object is not found
      getCenterObject: function (id, callback) {
        var that = this;

        //Call the GetData method
        this.getData(id, function (data) {
          //is the MAPPED data already cached?
          if (!objects[id])
            objects[id] = that.mapJsonData(data); //Map DATA to combine DATA and SCHEMA

          // Find the aggregation object
          var aggregate = that.findAggregateObject(objects[id]);

          //display an error if the center object cannot be found
          if (aggregate == undefined)
            alert("Fatal error: unable to find the aggregation object");

          // Get center object from mapped data, default to the aggregation object if no ID is provided
          var center = aggregate;
          if (id != null && id != undefined)
            center = that.getObjectById(objects[id], id);
          
          //display an error if the center object cannot be found
          if (center == undefined)
            alert("Fatal error: unable to find object " + id);
          
          //Is the center object found?
          if (center && !center.isLoaded) {
            //Only do this the first time this object is requested

            //Add aggregate object
            center.aggregate = aggregate;

            // Do something for the regular object
            if (center != aggregate) {
              //Add inverse relations
              center.inverseRelations = that.getInverseRelations(objects[id], center.id);

              //Move relation annotations to the respective relations (are already linked in object as normal relations)
              that.moveRelationAnnotations(center);

              //Remove the aggregation object
              that.removeAggregateFromRelations(center.relations);
              that.removeAggregateFromRelations(center.inverseRelations);

              center.combinedRelations = that.combineRelations(center.relations, center.inverseRelations);

              //Set this object as loaded
              center.isLoaded = true;
            }
            // Do something else for the aggregation object
            else {
              var temprelations = {};

              // Organize related objects according to base class
              for (var relationKey in center.relations) {
                $.each(center.relations[relationKey].objects, function (i, relatedObject) {
                  var baseClass = that.findBaseClass(relatedObject.object.getProperty(TypePropertyIdentifier).valueDescriptor);

                  // No annotations for the aggregation page (objects arent grouped by relationtype)
                  that.addRelation(temprelations, baseClass, relatedObject.object);
                });
              }

              // Clear all relation annotations (they do not show up on the aggregation page)
              delete temprelations[AnnotationTypeIdentifier];

              center.relations = temprelations;
              center.combinedRelations = temprelations;
            }
          }

          //Async function is finished, trigger callback with center object
          callback(center);
        });
      },

      // For the given type find the lowest base class (but take self if #Thing is found)
      // Note that #Thing is compared using the string, not the uri. So adding a specific #Thing
      // (other than the w3 one) is possible
      findBaseClass: function (classDescriptor) {
        // Fallback if no baseclass is ever found (self)
        var foundBaseClass = classDescriptor;

        // Get the parent class (if exists) from the schema (using isSubClassOf)
        var parentClass = schemaService.getParentClassFromSchema(classDescriptor);
        // While a parentClass exists
        while (parentClass) {
          // If the parenclass is no thing and is configured to be a base class, use it
          if (BaseClassTypes[parentClass] && BaseClassTypes[parentClass] != "thing")
            foundBaseClass = parentClass;

          parentClass = schemaService.getParentClassFromSchema(parentClass);
        }

        return foundBaseClass;
      },

      // Find the first base class (this one should have an icon)
      findClosestBaseClass: function (classDescriptor) {
        // If the class is a base class itself return it
        if (BaseClassTypes[classDescriptor])
          return BaseClassTypes[classDescriptor];

        // Get the parent class from the schema
        var parentClass = schemaService.getParentClassFromSchema(classDescriptor);
        // While a parentclass can be found and it's not a base class do some searching
        while (parentClass && !BaseClassTypes[parentClass]) {
          parentClass = schemaService.getParentClassFromSchema(parentClass);
        }

        // If parentclass contains a value then it is the closest baseclass
        if (parentClass) {
          return BaseClassTypes[parentClass];
        }
        // If the parentclass is not set then there is no baseclass, so revert to default base class (w3's #Thing)
        else {
          return BaseClassTypes[DefaultBaseClassTypeId];
        }
      },

      //gets a single object by id. Used the configured id property (if available)
      getObjectById: function (objects, id) {
        //No custom id property
        if (IdPropertyIdentifier == '') {
          return objects[id];
        }
        else {
          //Search for object id match on configured objectid property
          for (var objName in objects) {
            if (objects[objName].getId() == id) return objects[objName];
          }
        }

        sandbox.log("Current object not found", id);
      },

      //Gets all related objects pointing to this object
      getInverseRelations: function (objects, id) {
        var inverseRelations = {};

        //For each object
        for (var objName in objects) {
          var obj = objects[objName];

          //For each relation type
          for (var descriptor in obj.relations) {
            var objectArray = obj.relations[descriptor].objects;

            //For each URI in a relation type array, find the corresponding referenced object
            for (var i = 0; i < objectArray.length; i++) {
              var relatedId = objectArray[i].object.id;

              if (relatedId == id) {
                this.addRelation(inverseRelations, descriptor, obj);
              }
            }
          }
        }

        return inverseRelations;
      },

      // Combine relations with inverseRelations
      combineRelations: function (relations, inverseRelations) {
        // make a local copy of the first relations object
        var combinedRelations = $.extend({}, relations);

        // Traverse the second relations object
        for (var relationType in inverseRelations) {
          var relationObject = inverseRelations[relationType];
          // Determine if there is an inverse relation type, use it if it exists
          var key = relationObject.inverse ? relationObject.inverse : relationObject.descriptor;

          var that = this;
          $.each(relationObject.objects, function (i, relation) {
            // add the found relation to the combinedrelations (using the inverse key)
            that.addRelation(combinedRelations, key, relation.object, relation.annotations);
          });
        }

        return combinedRelations;
      },

      //Fills all relation annotations for 1 object
      moveRelationAnnotations: function (object) {
        //Get all relation annotations from the current data
        for (var key in object.inverseRelations) {
          var deletedIndices = [];

          var objKey = object.inverseRelations[key].objects.length;
          while (objKey--) {
            var relObject = object.inverseRelations[key].objects[objKey];

            //Is it an annotation?
            if (relObject.object.properties[TypePropertyIdentifier].valueDescriptor == AnnotationTypeIdentifier) {

              //Add this relation as annotation
              this.addRelationAnnotation(object, relObject.object);

              //Delete relation annotation as relation object
              object.inverseRelations[key].objects.splice(objKey, 1);
            }
          }
        }

        //If no more objects, delete relation type
        if (object.inverseRelations[key].objects.length == 0) {
          delete object.inverseRelations[key];
        }
      },

      //Add relation annotation
      addRelationAnnotation: function (object, annotation) {

        //Expected OBJECT and SUBJECT
        if (annotation.relations[ObjectAnnotationTypeIdentifier] && annotation.relations[SubjectAnnotationTypeIdentifier]) {

          var objectId = annotation.relations[ObjectAnnotationTypeIdentifier].objects[0].object.id;
          var subjectId = annotation.relations[SubjectAnnotationTypeIdentifier].objects[0].object.id;

          //Look in relations
          for (var key in object.relations) {
            for (var objKey = 0; objKey < object.relations[key].objects.length; objKey++) {

              var relObject = object.relations[key].objects[objKey];

              //Relation object ID same as SUBJECT or OBJECT?
              if (relObject.object.id == objectId || relObject.object.id == subjectId) {
                relObject.annotations.push(annotation);
              }
            }
          }

          //Look in inverse relations
          for (var key in object.inverseRelations) {
            for (var objKey = 0; objKey < object.inverseRelations[key].objects.length; objKey++) {

              var relObject = object.inverseRelations[key].objects[objKey];

              //Relation object ID same as SUBJECT or OBJECT?
              if (relObject.object.id == objectId || relObject.object.id == subjectId) {
                relObject.annotations.push(annotation);
              }
            }
          }
        }
      },

      // Determine the aggregation object in a set of objects
      findAggregateObject: function (objects) {
        for (key in objects) {
          if (objects[key].properties[TypePropertyIdentifier] != undefined && objects[key].properties[TypePropertyIdentifier].valueDescriptor == AggregateTypeIdentifier) {
            return objects[key];
          }
        }
      },

      //Remove aggregate from relations
      removeAggregateFromRelations: function (relationsObject) {

        //Get all inverse-relations from the current data
        for (var key in relationsObject) {
          for (var objKey = 0; objKey < relationsObject[key].objects.length; objKey++) {
            var relObject = relationsObject[key].objects[objKey];

            //Is it the aggregation object?
            if (relObject.object.properties[TypePropertyIdentifier].valueDescriptor == AggregateTypeIdentifier) {

              //Delete relation relation object
              relationsObject[key].objects.splice(objKey, 1);
            }
          }

          //If no more objects, delete relation type
          if (relationsObject[key].objects.length == 0) {
            delete relationsObject[key];
          }
        }

      },

      //Maps the json data to usable objects
      mapJsonData: function (data) {
        var objects = [];

        //Loop through all the objects in the data
        for (var objectId in data) {
          if (IdPropertyIdentifier && !data[objectId][IdPropertyIdentifier])
            continue;

          var externalId = objectId;
          if (IdPropertyIdentifier != "") {
            externalId = data[objectId][IdPropertyIdentifier][0].value;
          }
          var obj = new Visualizer.Node(objectId, externalId);

          //Add properties of object
          for (var propertyDescriptor in data[objectId]) {
            var propertyData = data[objectId][propertyDescriptor];

            var schemaDataType = schemaService.getPropertyTypeFromSchema(propertyDescriptor);

            for (var i = 0; i < propertyData.length; i++) {
              // Current type/value pair
              var typeValue = propertyData[i];

              // is the current type an uri and does it reference an object in the dataset
              if ((typeValue.type == URI_IDENTIFIER || typeValue.type == BNODE_IDENTIFIER) && data[typeValue.value] && schemaDataType == ObjectTypePropertyIdentifier) {
                //create relation
                this.addRelation(obj.relations, propertyDescriptor, typeValue.value);
              }
              else {
                //Create normal property
                var propertyLabel = schemaService.getPropertyNameFromSchema(propertyDescriptor);
                
                //Guess property labels from the URI if the property is not described by the schema
                if (propertyLabel == propertyDescriptor) {
                  //Keep only the part after the last / or # character
                  propertyLabel = propertyLabel.replace(/[^\/#]*[\/#]/g, '');
                  //Add spaces in front of any upper case character
                  propertyLabel = propertyLabel.replace(/([a-z])([A-Z])/g, '$1 $2');
                  //Convert the whole label to lower case
                  propertyLabel = propertyLabel.toLowerCase();
                  //Convert the first character to upper case
                  propertyLabel = propertyLabel.substr(0, 1).toUpperCase() + propertyLabel.substr(1);
                }

                var property = {
                  descriptor: propertyDescriptor,
                  valueDescriptor: typeValue.value,
                  value: schemaService.getPropertyNameFromSchema(typeValue.value),
                  label: propertyLabel,
                  type: typeValue.type
                };

                this.addProperty(obj, property);
              }
            }
          }
          
          //Determine the object's title
          for (var i = 0; i < TitlePropertyIdentifiers.length; i++) {
            var titlePropertyIdentifier = TitlePropertyIdentifiers[i];
            var value = obj.getPropertyValue(titlePropertyIdentifier);
            if (value != null) {
              //Title found
              obj.title = value;
              //Remove the statement from the object's properties
              delete obj.properties[titlePropertyIdentifier];
              break;
            }
          }
          if (obj.title == null) {
            obj.title = 'Unnamed object';
          }

          //Add to objects collection
          objects[obj.id] = obj;
        }

        //Replace uri by object reference for relations
        this.fillRelationReferences(objects);

        return objects;
      },

      //Add a relation with a specific descriptor to the array
      addRelation: function (relationsObject, descriptor, value, annotations) {
        if (!annotations)
          annotations = [];

        //is this the first relation of this type?
        if (!relationsObject[descriptor]) {
          var label = schemaService.getPropertyNameFromSchema(descriptor);
          var inverse = schemaService.getInverseFromSchema(descriptor);

          //Add relation type
          relationsObject[descriptor] = { descriptor: descriptor, inverse: inverse, label: label, objects: [] }
        }

        //Create object / annotations object
        var relAnnotation = { object: value, annotations: annotations }

        var isFound = false;
        //Try to find object in existing collection (we dont want objects to appear twice)
        for (var rel in relationsObject[descriptor].objects) {

          if (relationsObject[descriptor].objects[rel].object == value) {
            isFound = true;
          }
        }

        //Add to the collection (if it's not already found in the collection)
        if (!isFound) {
          relationsObject[descriptor].objects.push(relAnnotation);
        }
      },

      //Add property value to object
      addProperty: function (obj, property) {
        if ( property.descriptor == TypePropertyIdentifier && property.value == 'http://purl.org/info:eu-repo/semantics/EnhancedPublication' ) {
          //Workaround, do not process RDF type = http://purl.org/info:eu-repo/semantics/EnhancedPublication statements
          //The visualizer does not support multiple RDF type elements and will take the first type
          //The type http://purl.org/info:eu-repo/semantics/EnhancedPublication might mask http://www.openarchives.org/ore/terms/Aggregation
        }
        else {
          if (!obj.properties[property.descriptor]) {
            obj.properties[property.descriptor] = property;
          } else {
            //Concat if property has multiple values
            //We can't concatenate RDF type statements
            if (property.descriptor != TypePropertyIdentifier) {
              obj.properties[property.descriptor].value += ConcatCharacters + property.value;
            }
          }
        }
      },

      //Replace uri by object reference for relations
      fillRelationReferences: function (objects) {
        //For each object
        for (var objName in objects) {
          var obj = objects[objName];

          //For each relation type
          for (var descriptor in obj.relations) {
            var objectArray = obj.relations[descriptor].objects;

            //For each URI in a relation type array, find the corresponding referenced object
            for (var i = 0; i < objectArray.length; i++) {
              objectArray[i].object = objects[objectArray[i].object];
            }
          }
        }
      }
    };
  };
})(jQuery);/*
 * File: module/schemaservice.js
 * 
 * Copyright 2011  SURFfoundation
 * 
 * This file is part of InContext.
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *     http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * 
 * For more information: http://code.google.com/p/surf-incontext/
 */

(function ($) {
  //SchemaService

  Visualizer.SchemaService = function (moduleID, sandbox) {

    var schemaConnector;
    var jsonSchema;
    var URI_IDENTIFIER = 'uri';
    var BNODE_IDENTIFIER = 'bnode';

    //Identifiers defined by w3.org specs
    var LABEL_IDENTIFIER = 'http://www.w3.org/2000/01/rdf-schema#label';
    var TYPE_IDENTIFIER = 'http://www.w3.org/1999/02/22-rdf-syntax-ns#type';
    var SUBCLASS_IDENTIFIER = 'http://www.w3.org/2000/01/rdf-schema#subClassOf';

    return {
      init: function () {

        schemaConnector = sandbox.getService("schemaconnector");

        //Get schema
        schemaConnector.getSchema(function (schema) {
          jsonSchema = schema;

          sandbox.notify("ready");
        });
      },

      //Get the property label for an URI
      getPropertyNameFromSchema: function (uri) {
        var propertyName = uri;

        if (jsonSchema[uri] && jsonSchema[uri][LABEL_IDENTIFIER]) {
          propertyName = jsonSchema[uri][LABEL_IDENTIFIER][0].value;
        }

        return propertyName;
      },

      //Get the property label for an URI
      getPropertyTypeFromSchema: function (uri) {
        var propertyType = uri;

        if (jsonSchema[uri] && jsonSchema[uri][TYPE_IDENTIFIER]) {
          propertyType = jsonSchema[uri][TYPE_IDENTIFIER][0].value;
        }

        return propertyType;
      },

      //Gets the parent class
      getParentClassFromSchema: function (classDescriptor) {
        if (jsonSchema[classDescriptor] && jsonSchema[classDescriptor][SUBCLASS_IDENTIFIER]) {

          //It's an array, can have multiple values
          for (var i = 0; i < jsonSchema[classDescriptor][SUBCLASS_IDENTIFIER].length; i++) {

            //Return the first value where type is URI
            if (jsonSchema[classDescriptor][SUBCLASS_IDENTIFIER][i].type == URI_IDENTIFIER || jsonSchema[classDescriptor][SUBCLASS_IDENTIFIER][i].type == BNODE_IDENTIFIER) {
              return jsonSchema[classDescriptor][SUBCLASS_IDENTIFIER][i].value;
            }
          }
        }

        return null;
      },

      //Gets the inverse type of a relation
      getInverseFromSchema: function (uri) {
        var inverseTypeId = sandbox.getConfig("inverseTypeId");
        var symmetricTypeId = sandbox.getConfig("symmetricTypeId");

        var schemaObj = jsonSchema[uri];
        if (schemaObj) {
          if (schemaObj[inverseTypeId]) {
            return schemaObj[inverseTypeId][0].value;
          } else {
            for (i in schemaObj) {
              for (j in schemaObj[i]) {
                if (schemaObj[i][j].value == symmetricTypeId) {
                  return uri;
                }
              }
            }
          }
        }

        return;
      }
    };
  };
})(jQuery);/*
 * File: module/htmldrawservice.js
 * 
 * Copyright 2011  SURFfoundation
 * 
 * This file is part of InContext.
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *     http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * 
 * For more information: http://code.google.com/p/surf-incontext/
 */

/// <reference path="../dependencies/jquery-1.4.1.js"/>

(function ($) {

  //DrawService
  Visualizer.HtmlDrawService = function (moduleID, sandbox) {

    //Identifiers defined in config:
    var IdPropertyIdentifier = sandbox.getConfig("idProperty");
    var ImagePropertyIdentifier = sandbox.getConfig("imageTypeId");

    var DescriptionAnnotationPropertyIdentifier = sandbox.getConfig("descriptionAnnotationTypeId");

    var TypePropertyIdentifier = "http://www.w3.org/1999/02/22-rdf-syntax-ns#type";

    var dontShowProperties = [IdPropertyIdentifier, TypePropertyIdentifier, ImagePropertyIdentifier];
    if (sandbox.getConfig("dontShowProperties")) {
      dontShowProperties = dontShowProperties.concat(sandbox.getConfig("dontShowProperties"));
    }

    var maxWidth = sandbox.getConfig("maxWidth");
    var LinkTarget = sandbox.getConfig("linkTarget");
    var ObjectLinkTarget = sandbox.getConfig("objectLinkTarget");

    var innerWidth = maxWidth - 20; // width minus padding;


    //Service references:
    var historyManager;
    var dataService;
    var cloudService;
    var animationService;

    //The DIV defined in HTML
    var outerCanvas;

    //Inner DIV with our own specified ID and CLASS
    var innerCanvas;

    //Holds the current visible visualization
    var currentStateCanvas;
    var currentObject;

    var popups = [];

    return {
      init: function () {
        historyManager = sandbox.getService("historymanager");
        dataService = sandbox.getService("dataservice");
        cloudService = sandbox.getService("cloudservice");
        animationService = sandbox.getService("animationservice");

        //Create the innerCanvas when the document is ready
        sandbox.subscribe("document.ready", function () {
          outerCanvas = $("#" + sandbox.getConfig("canvasId"));
          if (!outerCanvas.length) {
            alert("Fatal error: canvas not found!");
          }
          else {
            if (!outerCanvas.hasClass("visualizer_canvas")) {
              outerCanvas.addClass("visualizer_canvas");
            }
            innerCanvas = $('<div id="visualizer_innercanvas" class="visualizer_innercanvas"></div>');
            outerCanvas.append(innerCanvas);

            outerCanvas.css("width", maxWidth);
          }
        }, this);
      },

      //Get the property label for an URI
      beginDraw: function (object) {

        //Draw new canvas
        var newStateCanvas = $('<div class="visualizer_statecanvas"></div>');

        // Move the new canvas out of the screen while computing (display: none will disrupt height and width calculations)
        newStateCanvas.css('visibility', 'hidden');

        //Hide it before adding it to the innerCanvas (animation service will show it)
        innerCanvas.append(newStateCanvas);

        //Draw main Aggregation title bar
        this.drawTitleBar(newStateCanvas, object);

        //Draw clouds
        this.drawClouds(newStateCanvas, object);

        //Execute fixes for IE
        if ($.browser.msie) {
          this.fixIE(object);
        }

        //Start animation
        animationService.beginTransition(innerCanvas, currentObject, currentStateCanvas, object, newStateCanvas, function () {
          //Callback when animation is finished

          //Always remove current state canvas
          if (currentStateCanvas)
            currentStateCanvas.remove();

          //Always show newStateCanvas and change height of innerCanvas
          newStateCanvas.css('visibility', 'visible');
          innerCanvas.css('height', newStateCanvas.outerHeight());
          
          currentStateCanvas = newStateCanvas;
          currentObject = object;
          
        });

      },

      //Dwars title bar which holds Aggregation name
      drawTitleBar: function (canvas, object) {
        var that = this;

        var divTitlebar = $('<div class="titlebar"></div>');
        canvas.append(divTitlebar);

        this.drawBreadCrumbs(canvas, divTitlebar);

        var h2Title = $('<h2><span class="text">' + object.aggregate.getTitle() + '</span></h2>');
        var popup;

        //Navigate to aggregation on click
        h2Title.click(function (event) {
          sandbox.notify("object-click", object.aggregate.getId());
        })
				.mouseover(function () {
				  $(this).addClass('hover');
				  if (!popup) {
				    popup = that.openPopup(h2Title, 'Show aggregation overview', { positionClass: 'bottom', maxWidth: 200 });
				  }
				  if (!popup.isOpen)
				    popup.open();
				})
        .mouseout(function () {
          $(this).removeClass('hover');
          if (popup && popup.isOpen)
            popup.close();
        });

        divTitlebar.append(h2Title);
      },

      //Draw breadcrums using historymanager
      drawBreadCrumbs: function (canvas, titlebar) {
        var divBreadcrumbs = $('<div class="breadcrumbs"></div>');
        titlebar.append(divBreadcrumbs);

        var that = this;
        var historyArray = historyManager.getHistory(5);
        if (historyArray.length > 0) {
          var ul = $('<ul />').appendTo(divBreadcrumbs);
          $.each(historyArray, function (i, historyObject) {
            if (historyObject) {
              var aBreadcrumb;
              if (i == historyArray.length - 1) {
                aBreadcrumb = $('<span>' + historyObject.getId() + '</span>')
							  .addClass("breadcrumb")
							  .addClass(dataService.findClosestBaseClass(historyObject.getProperty(TypePropertyIdentifier).valueDescriptor));
              }
              else {
                var popup;

                aBreadcrumb = $('<a href="#">' + historyObject.getId() + '</a>')
							  .attr("rel", historyObject.getId())
							  .addClass("breadcrumb")
							  .addClass(dataService.findClosestBaseClass(historyObject.getProperty(TypePropertyIdentifier).valueDescriptor))
							  .click(function (event) {
							    event.preventDefault();
							    sandbox.notify("history-click", historyArray.length - 1 - i);
							  })
                .mouseover(function () {
                  if (!popup) {
                    popup = that.openPopup(aBreadcrumb, that.contentBreadCrumbPopup(historyObject), { positionClass: 'bottom', maxWidth: 200 });
                  }
                  if (!popup.isOpen)
                    popup.open();
                })
                .mouseout(function () {
                  if (popup && popup.isOpen)
                    popup.close();
                })
                .click(function () {
                  if (popup && popup.isOpen)
                    popup.close();
                });
              }

              var li = $('<li />').append(aBreadcrumb);

              li.appendTo(ul);
            }
          });
        }
      },

      contentBreadCrumbPopup: function (object) {
        var div = $('<div class="breadcrumb_popup">' +
          '<div class="type">' + object.getPropertyValue(TypePropertyIdentifier) + '</div>' +
          '<div class="title">' + object.getTitle() + '</div>' +
        '</div>');

        return div;
      },

      drawClouds: function (canvas, object) {
        // Get all clouds ordered by descending weight (combination of number and total textlength)
        var clouds = cloudService.gatherClouds(object.combinedRelations);

        // Exception rule for 1 relation type
        if (clouds.length == 0) {
          // draw row 1 with only the centerobject in it
          var container = $('<div class="cloud_row"/>');
          canvas.append(container);
          this.drawEmptyCloud(container, 3);
          this.drawCenterObject(container, object);
          this.drawEmptyCloud(container, 4);
        }
        else if (clouds.length == 1) {
          // first draw row 1 with only the centerobject in it
          var container = $('<div class="cloud_row"/>');
          canvas.append(container);
          this.drawEmptyCloud(container, 3);
          this.drawCenterObject(container, object);
          this.drawEmptyCloud(container, 4);

          // then draw row 2 with the only cloud in it
          var container = $('<div class="cloud_row"/>');
          canvas.append(container);
          this.drawEmptyCloud(container, 8);
          this.drawRelationCloud(container, 1, clouds[0], 3);
          this.drawEmptyCloud(container, 7);
        }
        // Exception rule for 2 relation types
        else if (clouds.length == 2) {
          // draw only one row with the centerobject and both clouds in it
          var container = $('<div class="cloud_row"/>');
          canvas.append(container);

          this.drawRelationCloud(container, 3, clouds[0]);
          this.drawCenterObject(container, object);
          this.drawRelationCloud(container, 4, clouds[1]);
        }
        // Exception rule for 2 relation types
        else if (clouds.length == 3) {
          // draw row 1 with the centerobject and cloud 2 and 3 in it
          var row1container = $('<div class="cloud_row"/>');
          canvas.append(row1container);

          var pos3div = this.drawRelationCloud(row1container, 3, clouds[1]);
          var center = this.drawCenterObject(row1container, object);
          var pos4div = this.drawRelationCloud(row1container, 4, clouds[2]);

          // create a temporary container
          var row2Container = $('<div class="cloud_row"/>');
          canvas.append(row2Container);

          this.drawEmptyCloud(row2Container, 5);
          // Draw as two columns for test purposes
          var tempDiv = this.drawRelationCloud(row2Container, 1, clouds[0], 2);

          // If the two column version of the first cloud would look nice floated against the left
          if (pos3div.outerHeight() - Math.max(center.outerHeight(), pos4div.outerHeight()) > (tempDiv.outerHeight() / 2)) {
            row1container.append(tempDiv);
            row2Container.remove();
          }
        }
        // General rule for more than 3 relation types
        // 8   2   7
        // 3   -1  4
        // 5   1   6
        else {
          var row1container = $('<div class="cloud_row"/>');
          canvas.append(row1container);

          var row2container = $('<div class="cloud_row"/>');
          canvas.append(row2container);

          var row3container = $('<div class="cloud_row"/>');
          canvas.append(row3container);

          var position1allowedColumns = 1;
          if (clouds.length < 6)
            position1allowedColumns = 2;
          if (clouds.length < 5)
            position1allowedColumns = 3;

          var position2allowedColumns = 1;
          if (clouds.length < 8)
            position2allowedColumns = 2;
          if (clouds.length < 7)
            position2allowedColumns = 3;

          // Draw topleft corner if there are 8 or more clouds
          if (clouds.length >= 8) {
            this.drawRelationCloud(row1container, 8, clouds[7]);
          }
          else {
            // Draw empty cloud if cloud 2 doesn't have enough objects for 3 columns
            if (clouds[1].objects.length < 3) {
              this.drawEmptyCloud(row1container, 8);
            }
          }

          // Draw top
          this.drawRelationCloud(row1container, 2, clouds[1], position2allowedColumns);

          // Draw topright corner if there are 7 or more clouds
          if (clouds.length >= 7) {
            this.drawRelationCloud(row1container, 7, clouds[6]);
          }
          else {
            // Draw empty cloud if cloud 2 doesn't have enough objects for 2 columns
            if (clouds[1].objects.length < 2) {
              this.drawEmptyCloud(row1container, 7);
            }
          }

          // Draw left
          var pos3div = this.drawRelationCloud(row2container, 3, clouds[2]);

          // Draw center
          var centerdiv = this.drawCenterObject(row2container, object);

          // Draw right
          var pos4div = this.drawRelationCloud(row2container, 4, clouds[3]);

          // Draw bottomleft corner if there are 5 or more clouds
          if (clouds.length >= 5) {
            this.drawRelationCloud(row3container, 5, clouds[4]);
          }
          else {
            // Draw empty cloud if cloud 1 doesn't have enough objects for 3 columns
            if (clouds[0].objects.length < 3) {
              this.drawEmptyCloud(row3container, 5);
            }
          }

          var appendOneLeftoverToColumn3 = false;

          // create a temporary container
          var temporaryContainer = $('<div class="cloud_row"/>');
          canvas.append(temporaryContainer);

          // Draw as two columns for test purposes
          var tempDiv = this.drawRelationCloud(temporaryContainer, 1, clouds[0], 2);

          // If the two column version of the first cloud would look nice floated against the left append it to row 2
          if (pos3div.outerHeight() - Math.max(centerdiv.outerHeight(), pos4div.outerHeight()) > (tempDiv.outerHeight() / 2)) {
            row2container.append(tempDiv);

            // There should be a position left over for a leftover cloud on row 3
            appendOneLeftoverToColumn3 = true;
          }
          // else create a new cloud and append it to row 3
          else {
            this.drawRelationCloud(row3container, 1, clouds[0], position1allowedColumns);
          }

          // remove the temporary container
          temporaryContainer.remove();

          // Draw bottomright corner if there are 6 or more clouds
          if (clouds.length >= 6) {
            this.drawRelationCloud(row3container, 6, clouds[5]);
          }
          else {
            // Draw empty cloud if cloud 1 doesn't have enough objects for 2 columns
            if (clouds[0].objects.length < 2) {
              this.drawEmptyCloud(row3container, 5);
            }
          }

          // All leftover rows should be appended to new rows (except maybe the first)
          if (clouds.length > 8) {
            var start = 8;

            if (appendOneLeftoverToColumn3) {
              this.drawRelationCloud(row3container, 9, clouds[8]);
              var start = 9;
            }

            if (clouds.length > start) {
              var counter = 0;
              var rowContainer;

              for (var i = start; i < clouds.length; i++) {
                if (i % 3 == 0) {
                  rowContainer = $('<div class="cloud_row"/>');
                  canvas.append(rowContainer);
                }

                this.drawRelationCloud(rowContainer, i + 1, clouds[i]);
                counter++;
              }
            }
          }
        }
      },

      //Draws the main center object
      drawCenterObject: function (container, object) {
        var divCenterObject = $('<div class="centerobject"/>');
        divCenterObject.css("width", Math.floor(innerWidth / 3) + "px");

        var divPadding = $('<div class="padding"/>');
        divCenterObject.append(divPadding);

        container.append(divCenterObject);

        var divTypeIcon = $('<div class="type_icon" />');
        var spanCenter = $('<span class="' + dataService.findClosestBaseClass(object.getProperty(TypePropertyIdentifier).valueDescriptor) + '"></span>');

        divTypeIcon.append(spanCenter);
        divPadding.append(divTypeIcon);

        var divType = $('<div class="type">' + object.getPropertyValue(TypePropertyIdentifier) + '</div>');
        divPadding.append(divType);

        var divTitle = $('<div class="title">' + object.getTitle() + '</div>');
        divPadding.append(divTitle);

        //Don't show properties when false is specified in config for showProperties setting
        if (sandbox.getConfig("showProperties")) {
          var divProperties = $('<div class="properties" />');

          var that = this;

          //Show all properties, except properties in the dontShowProperties array
          $.each(object.properties, function (i, o) {
            if ($.inArray(o.descriptor, dontShowProperties) == -1) {

              //Draw link when property type is uri and value strarts with http://
              if (o.type == 'uri') {
                divProperties.append(that.drawLinkProperty(o.label, o.value));
              }
              else {
                //Default: draw property as plain text label label
                var propertyDiv = $('<div class="property"/>');
                var labelDiv = $('<div class="label">' + o.label + '</div>');
                var valueDiv = $('<div class="value">' + o.value + '</div>');

                propertyDiv.append(labelDiv);
                propertyDiv.append(valueDiv);

                divProperties.append(propertyDiv);
              }
            }
          });

          divPadding.append(divProperties);

          //Always draw image last
          if (object.properties[ImagePropertyIdentifier]) {
            var imageDiv = $('<div class="image"/>');
            var image = $('<img src="' + object.properties[ImagePropertyIdentifier].value + '" class="centerobjectimage" />');

            imageDiv.append(image);
            divProperties.append(imageDiv);
          }

        }

        var divObjectLink = this.drawObjectLinkProperty(object.id, object.getId());
        if (divObjectLink) {
          divPadding.append(divObjectLink);
        }

        return divCenterObject;
      },

      //Draws a link property based on the configured LinkTarget
      drawLinkProperty: function (name, value) {

        var propertyDiv = $('<div class="property"/>');
        var labelDiv = $('<div class="label">' + name + '</div>');
        var valueDiv = $('<div class="value"></div>');

        propertyDiv.append(labelDiv);
        propertyDiv.append(valueDiv);

        //Only create a link if the LinkTarget is specified
        if (LinkTarget && LinkTarget.length > 0) {

          var viewUrl = value;

          if (value.indexOf('http://') == 0) {

            //Strip URL to only show domain name
            viewUrl = this.getSmallUrl(value);
          }
          else if (value.indexOf('mailto:') == 0) {
            //Strip URL to only show domain name
            viewUrl = value.replace('mailto:', '');
          }
          else if (value.indexOf('tel:') == 0) {
            viewUrl = value.replace('tel:', '');
          }

          var anchor = $('<a href="' + value + '">' + viewUrl + '</a>');
          valueDiv.append(anchor);

          var iconSpan = $('<span class="externalLink"></span>');
          if (LinkTarget == "_blank") {
            anchor.append(iconSpan);
          }

          //Set target
          anchor.attr('target', LinkTarget);
          anchor.click(function (event) {

            //Do not open the actual link if the target is _none
            if (LinkTarget == '_none') {
              event.preventDefault();
            }

            //Notify (external) application using uri-click event
            sandbox.notify("uri-click", value);
          });
        }
        else {
          //no LinkTarget specified, set value as plain text
          valueDiv.text(value);
        }

        return propertyDiv;
      },

      //Draws the OBJECT link property based on the configured ObjectLinkTarget
      drawObjectLinkProperty: function (id, externalId) {

        //Only create a link if the LinkTarget is specified
        if (ObjectLinkTarget && ObjectLinkTarget.length > 0) {
          var propertyDiv = $('<div />');

          var anchor = $('<a class="objectLink" href="' + id + '">More info</a>');
          propertyDiv.append(anchor);

          var iconSpan = $('<span class="externalLink"></span>');
          if (ObjectLinkTarget == "_blank") {
            anchor.append(iconSpan);
          }

          //Set target
          anchor.attr('target', ObjectLinkTarget);

          anchor.click(function (event) {

            //Do not open the actual link if the target is _none
            if (ObjectLinkTarget == '_none') {
              event.preventDefault();
            }

            //Notify (external) application using uri-click event
            sandbox.notify("object-uri-click", { "id": id, "externalId": externalId });
          });

          return propertyDiv;

        }

      },

      //Strip URL to only show domain name
      getSmallUrl: function (url) {
        var startDomain = url.indexOf('//');

        if (startDomain > 0) {
          var endDomain = url.indexOf('/', startDomain + 2)

          //If no end slash is found, use full URL
          if (endDomain == -1)
            endDomain = url.length;

          return url.substring(0, endDomain);
        }

        return url;

      },

      //Draws an empty cloud to take space but don't show anything
      drawEmptyCloud: function (container, position) {
        var cloudDiv = $('<div class="cloud position' + position + '"/>');
        cloudDiv.css("width", Math.floor(innerWidth / 3) + "px");

        container.append(cloudDiv);

        return cloudDiv;
      },

      //Draws a relation cloud showing the related objects
      drawRelationCloud: function (container, position, relationObject, allowedColumns) {
        if (!allowedColumns)
          allowedColumns = 1;

        var columns = 1;

        if (position == 1 || position == 2) {
          if (relationObject.objects.length > 1)
            columns = Math.min(allowedColumns, 2);
          if (relationObject.objects.length % 3 == 0 || relationObject.objects.length > 4)
            columns = Math.min(allowedColumns, 3);
        }

        var cloudDiv = $('<div class="cloud position' + position + ' columns' + columns + '"></div>');
        cloudDiv.css("width", Math.floor((columns / 3) * innerWidth) + "px");

        var cloudFieldset = $('<fieldset class="cloud"></fieldset>');
        cloudDiv.append(cloudFieldset);
        var cloudFieldsetLegend = $('<legend>' + relationObject.label + '</legend>');
        cloudFieldset.append(cloudFieldsetLegend);

        var that = this;
        var counter = 0;
        var cloudObjects;

        // Sort the objects based on title
        relationObject.objects.sort(function (a, b) {
          var aTitle = a.object.getTitle();
          var bTitle = b.object.getTitle();

          if (aTitle < bTitle) return -1;
          if (aTitle > bTitle) return 1;
          return 0;
        });

        //Draw each object for this relation
        $.each(relationObject.objects, function (i, o) {
          if (counter % Math.ceil(relationObject.objects.length / columns) == 0) {
            cloudObjects = $('<ul class="objects"></ul>');
            cloudFieldset.append(cloudObjects);
          }

          //Draw object
          var liObject = that.drawObject(cloudObjects, o.object);

          //Draw annotations
          that.drawAnnotations(liObject, o.annotations);

          counter++;
        });

        container.append(cloudDiv);

        return cloudDiv;
      },

      //Draws a related object inside a relation cloud
      drawObject: function (container, object) {
        var previousObject = historyManager.getPreviousObject();

        var liObject = $('<li class="object' +
              (previousObject && previousObject.getId() == object.getId() ? ' previous' : '') +
              '">' +
              '<div class="padding">' +
						    '<div class="type_icon">' +
                  '<span class="' + dataService.findClosestBaseClass(object.getProperty(TypePropertyIdentifier).valueDescriptor) + '"></span>' +
                '</div>' +
                '<div class="type">' +
                  object.getPropertyValue(TypePropertyIdentifier) +
                '</div>' +
                '<div class="title">' +
                  '<a class="objectlink" href="#" rel="' +
                  object.getId() +
                  '">' +
                  object.getTitle() +
                  '</a>' +
                '</div>' +
                '<div class="annotations"/>' +
                '<div class="gradient" />' +
              '</div>' +
            '</li>');

        container.append(liObject);

        //Handle object click
        liObject.click(function (event) {
          event.preventDefault();

          // Do not navigate after a click on the annotations div
          if (!$(event.target).closest(".annotations").length) {
            var id = $(this).find(".objectlink").attr("rel");

            sandbox.notify("object-click", id);
          }
        });

        return liObject;
      },

      //Create (html)content for annotation popup
      contentAnnotationsPopup: function (annotations) {

        var html = '<div class="annotations_title">Relation annotations (' + annotations.length + ')</div>';

        html += '<ul class="annotations_list">';
        $.each(annotations, function (i, o) {
          html += '<li'
          if (i == annotations.length - 1) {
            html += ' class="last"';
          }
          html += '>'
          if (o.properties[DescriptionAnnotationPropertyIdentifier]) {
            html += o.properties[DescriptionAnnotationPropertyIdentifier].value + "";
          }
          html += '</li>';
        });
        html += '</ul>';

        return html;
      },

      //Draws annotation link inside object representation
      //Able to hover and click on this link
      drawAnnotations: function (container, annotations) {
        if (annotations.length > 0) {
          var divAnnotations = container.find('.annotations');
          var aAnnotations = $('<a class="annotation_indication" href="#">Relation annotations (' + annotations.length + ')</a>');

          var that = this;

          var clickPopup;
          var hoverPopup;

          //Show popup on click
          aAnnotations.click(function (event) {
            event.preventDefault();

            that.closePopups();

            if (!clickPopup)
              clickPopup = that.openPopup(aAnnotations, that.contentAnnotationsPopup(annotations), { closeButton: true, maxWidth: (Math.floor(innerWidth / 3) * 2) });

            if (!clickPopup.isOpen)
              clickPopup.open();
          });

          //Show hover menu on mouseover
          aAnnotations.mouseover(function () {
            if (!clickPopup || !clickPopup.isOpen) {
              if (!hoverPopup) {
                hoverPopup = that.openPopup(aAnnotations, '<span class="indicator-text">' + aAnnotations.text() + '</span>', { positionClass: 'top' });
              }

              if (!hoverPopup.isOpen)
                hoverPopup.open();
            }
          });

          //Hide hovermenu on mouseout
          aAnnotations.mouseout(function () {
            if (hoverPopup && hoverPopup.isOpen)
              hoverPopup.close();
          });

          divAnnotations.append(aAnnotations);

          return divAnnotations;
        }
      },


      openPopup: function (openingElement, content, options) {
        var popup = new Visualizer.HtmlPopup(innerCanvas, openingElement, options);
        popups.push(popup);

        popup.setContent(content);
        popup.open();

        return popup;
      },

      closePopups: function () {
        $.each(popups, function (i, popup) {
          popup.close();
        });
      },

      // Fix IE6
      fixIE: function (object) {
        if ($.browser.version == 6) {
          $('li.object').mouseover(function () {
            $(this).addClass("hover");
          });

          $('li.object').mouseout(function () {
            $(this).removeClass("hover");
          });
        }

        // Fix everything but IE8 and higher
        if ($.browser.version < 8) {
          $('div.gradient').each(function () {
            $(this).css({ "margin": "0px", "position": "absolute", "left": "0px", "bottom": "0px" });
            $(this).width($(this).parent().innerWidth());

            var borderWidth = $(this).outerWidth() - $(this).innerWidth();
            if (borderWidth > 0) {
              $(this).width($(this).width() - borderWidth);
            }
          });
        }
      }
    };
  }
})(jQuery);/*
 * File: module/historymanager.js
 * 
 * Copyright 2011  SURFfoundation
 * 
 * This file is part of InContext.
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *     http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * 
 * For more information: http://code.google.com/p/surf-incontext/
 */

//SchemaService

(function ($) {
  Visualizer.HistoryManager = function (moduleID, sandbox) {

    var UseHistoryManager = sandbox.getConfig("useHistoryManager");
    var firstTime = true;

    var history = [];

    var currentId;

    return {
      init: function () {

        //Only register event if we use history manager
        if (UseHistoryManager) {

          //Gets notification if URL changes
          $.address.change(function (event) {

            var currentId = event.parameters.id;

            //Do ready event for the first time, with the urlId
            if (firstTime) {
              firstTime = false;
              sandbox.notify("ready", currentId);
            }
            else {
              sandbox.log('Load by URL', currentId);
              sandbox.notify("load-object", currentId);
            }
          });
        }

        // listen to clicks on breadcrumb
        sandbox.subscribe("*.history-click", function (event) {
          var steps = event.data;

          // remove all historical steps after the clicked one
          history = history.slice(0, history.length - 1 - steps);

          // move history back
          window.history.go(-steps);

          // Notify an object clicked event
        }, this);
      },

      // Return an array with history data (optionally with a fixed number)
      getHistory: function (maxNumber) {
        if (maxNumber)
          return history.slice(Math.max(0, history.length - maxNumber));

        return history;
      },

      // Set a current object
      setCurrentObject: function (object) {
        // If the new current object is the previous object, remove the old current object
        if (history[history.length - 2] && object.getId() == history[history.length - 2].getId())
          history.pop();
        // Else put it at the end of the history array
        else
          history.push(object);
      },

      //Gets previous object
      getPreviousObject: function () {
        if (history[history.length - 2]) {
          return history[history.length - 2];
        }
      }
    };
  };
})(jQuery);/*
 * File: module/cloudservice.js
 * 
 * Copyright 2011  SURFfoundation
 * 
 * This file is part of InContext.
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *     http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * 
 * For more information: http://code.google.com/p/surf-incontext/
 */

(function ($) {

  // Service for the gathering of clouds
  // A cloud is a group of related objects to the center object
  Visualizer.CloudService = function (moduleID, sandbox) {

    return {
      // Order all relation objects in one array based on weight
      gatherClouds: function (relationObjects) {
        // If the parameter is just one relationObject make an array of it
        if (!$.isArray(relationObjects))
          relationObjects = [relationObjects];

        // result array
        var clouds = [];

        // For all relationObjects ...
        $.each(relationObjects, function (i, relationObject) {
          // ... and all types in that object
          for (var relationType in relationObject) {
            // Push it into the result array
            clouds.push(relationObject[relationType]);
          }
        });

        // preserve context
        var that = this;
        // sort the array
        clouds.sort(function (a, b) { return that.sortClouds(a, b); });

        return clouds;
      },

      // sorting method
      sortClouds: function (cloudA, cloudB) {
        // reverse sort (descending by weight)
        return getWeight(cloudB) - getWeight(cloudA);
      }
    };

    // utility method to determine the weight of a cloud
    function getWeight(cloud) {
      var lines = 0;

      $.each(cloud.objects, function (i, o) {
        // each object contributes a type line and some padding and borders
        lines += 2;
        if (o.object.getTitle()) {
          // A text line is average of 4 words, so add (total words / 4)
          lines += o.object.getTitle().split(' ').length / 4;
        }
      });

      return lines;
    }
  };
})(jQuery);/*
 * File: module/navigationservice.js
 * 
 * Copyright 2011  SURFfoundation
 * 
 * This file is part of InContext.
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *     http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * 
 * For more information: http://code.google.com/p/surf-incontext/
 */

(function ($) {
  Visualizer.NagivationService = function (moduleID, sandbox) {

    var historymanager;

    return {
      init: function () {
        historymanager = sandbox.getService("historymanager");

        //Listen to object clicks
        sandbox.subscribe("*.object-click", function (event) {
          var objectId = event.data;

          var previousObject = historymanager.getPreviousObject();

          // If the clicked object is the previous one, let the historymanager handle the moving back
          if (sandbox.getConfig("useHistoryManager") && previousObject && previousObject.getId() == objectId) {
            sandbox.notify("history-click", 1);
          }
          // else notify that the object should be loaded
          else {
            //Set address if history manager is used
            if (sandbox.getConfig("useHistoryManager")) {
              $.address.value('?id=' + encodeURIComponent(objectId));
            }
            else {
              //Else, load objects
              sandbox.notify("load-object", objectId);
            }
          }
        }, this);

        //Listen to load object
        sandbox.subscribe("*.load-object", function (event) {
          //Only proceed if all services are ready
          var dataService = sandbox.getService("dataservice");
          var drawService = sandbox.getService("drawservice");
          var historyManager = sandbox.getService("historymanager");

          // assign id from event.data
          var id = event.data;

          // If there is no object id passed to the event, take the default id
          if (!event.data)
            id = sandbox.getConfig("startObjectId");

          //historyManager.setCurrentObjectId(id);

          //Load data and draw
          dataService.getCenterObject(id, function (centerObj) {
            historyManager.setCurrentObject(centerObj);

            drawService.beginDraw(centerObj);
            sandbox.notify("load-object-ready", centerObj.getId());
          });
        }, this);
      }
    }
  };
})(jQuery);/*
 * File: module/animationservice.js
 * 
 * Copyright 2011  SURFfoundation
 * 
 * This file is part of InContext.
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *     http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * 
 * For more information: http://code.google.com/p/surf-incontext/
 */

(function ($) {
  Visualizer.AnimationService = function (moduleID, sandbox) {

    var canvas;
    var animationCanvas;

    var copyStyles = ['font-size', 'font-weight', 'font-style', 'color',
        'text-transform', 'text-decoration', 'letter-spacing', 'word-spacing',
        'line-height', 'text-align', 'vertical-align', 'direction', 'background-color',
        'background-image', 'background-repeat', 'background-position',
        'background-attachment', 'opacity', 'width', 'height',
        'margin-top', 'margin-right', 'margin-bottom', 'margin-left',
        'padding-top', 'padding-right', 'padding-bottom', 'padding-left',
        'border-top-width', 'border-right-width', 'border-bottom-width',
        'border-left-width', 'border-top-color', 'border-right-color',
        'border-bottom-color', 'border-left-color', 'border-top-style',
        'border-right-style', 'border-bottom-style', 'border-left-style',
        'display', 'visibility', 'z-index', 'overflow-x', 'overflow-y', 'white-space',
        'clip', 'float', 'clear', 'cursor', 'list-style-image', 'list-style-position',
        'list-style-type', 'marker-offset'];

    var animationStyles = ['font-size', 'color', 'line-height', 'opacity',
        'margin-top', 'margin-right', 'margin-bottom', 'margin-left',
        'padding-top', 'padding-right', 'padding-bottom', 'padding-left',
        'background-color'];

    function isTransparent(value) {
      if (value.indexOf("rgba") != -1)
        return true;
      if (value == 'transparent')
        return true;
    }

    return {

      beginTransitionA: function (_canvas, fromObject, fromStateCanvas, toObject, toStateCanvas, callback) {

        if (callback)
          callback();
      },

      //Starts the transition between the current and new canvas
      beginTransition: function (_canvas, fromObject, fromStateCanvas, toObject, toStateCanvas, callback) {
        canvas = _canvas;

        var that = this;

        if (animationCanvas) {
          animationCanvas.remove();
        }

        // create a canvas for the transition story (the from and to objects moving to their new positions)
        animationCanvas = this.createAnimationLayer(canvas, fromStateCanvas, toStateCanvas);

        // Animate from an object?
        if (fromObject) {
          fromStateCanvas.css('z-index', "3000");

          // Fadeout the previous state
          fromStateCanvas.fadeOut(200);

          var duration = 500;

          if (fromStateCanvas.height() < toStateCanvas.height()) {
            canvas.animate({
              'height': toStateCanvas.outerHeight()
            }, 300);
          }

          // Animate from the aggregation (as centerobject)
          if (fromObject == fromObject.aggregate) {
            this.animateCenterToTitle(fromStateCanvas, toStateCanvas, duration);
          }
          // Animate from an existing object to center
          else {
            var sourceFrom = fromStateCanvas.find('div.centerobject .padding');
            var targetFrom = toStateCanvas.find('div.title a[rel="' + fromObject.getId() + '"]').closest('li.object');

            if (targetFrom.length) {
              this.animateCenterToCloudObject(sourceFrom, targetFrom, duration);
            }
          }

          // Animate to the aggregation (as title)
          if (toObject == toObject.aggregate) {
            this.animateTitleToCenter(fromStateCanvas, toStateCanvas, duration);
          }
          // Regular animation
          else {
            var sourceTo = fromStateCanvas.find('li.object a[rel="' + toObject.getId() + '"]').closest('li.object');
            var targetTo = toStateCanvas.find('div.centerobject .padding');

            if (sourceTo.length) {
              this.animateCloudObjectToCenter(sourceTo, targetTo, duration);
            }
          }

          var wait = setInterval(function () {
            if (animationCanvas) {
              if (!animationCanvas.find(":animated").length) {
                clearInterval(wait);

                if (fromStateCanvas.height() > toStateCanvas.height()) {
                  canvas.animate({
                    'height': toStateCanvas.outerHeight()
                  }, 300);
                }

                toStateCanvas.css('visibility', 'visible');

                that.fadeIn(toStateCanvas, 100, function () {

                  if (animationCanvas) {
                    animationCanvas.fadeOut(200, function () {
                      if (animationCanvas) {
                        animationCanvas.remove(); animationCanvas = null;
                      }
                    });
                  }

                  //Callback when animation is finished
                  if (callback)
                    callback();
                });
              }
            }
          }, 100);
        }
        // Animate without previous state
        else {
          canvas.animate({ "height": toStateCanvas.outerHeight() }, 100, function () {
            toStateCanvas.css('visibility', 'visible');
            that.fadeIn(toStateCanvas, 300, function () {

              animationCanvas.remove();
              animationCanvas = null;

              //Callback when animation is finished
              if (callback)
                callback();
            });
          });
        }
      },

      createAnimationLayer: function (canvas, fromStateCanvas, toStateCanvas) {
        // create a canvas for the transition story (the from and to objects moving to their new positions)
        var animationCanvas = $('<div class="visualizer_statecanvas"></div>');
        canvas.append(animationCanvas);

        animationCanvas.append(toStateCanvas.find('.titlebar').clone());

        var animationCanvasHeight = Math.max(fromStateCanvas ? fromStateCanvas.height() : 0, toStateCanvas.height());

        animationCanvas.css({
          'background-color': 'transparent',
          'z-index': 2000,
          'width': toStateCanvas.width(),
          'height': animationCanvasHeight
        });

        return animationCanvas;
      },

      animateCenterToTitle: function (fromStateCanvas, toStateCanvas, time) {
        var center = fromStateCanvas.find('.centerobject');
        var centerTitle = fromStateCanvas.find('.centerobject .title');
        var title = toStateCanvas.find('.titlebar h2');

        var centerTitleCopy = centerTitle.clone();
        animationCanvas.append(centerTitleCopy);
        centerTitleCopy.css({
          "position": "absolute",
          "color": centerTitle.css("color"),
          'text-align': 'center',
          'width': centerTitle.width(),
          'background-color': center.css("background-color")
        });

        centerTitleCopy.offset(centerTitle.offset());

        centerTitleCopy.animate({
          left: title.offset().left - title.offsetParent().offset().left,
          top: title.offset().top - title.offsetParent().offset().top,
          height: title.height(),
          width: title.width(),
          fontSize: title.css('fontSize'),
          color: title.css('color'),
          backgroundColor: toStateCanvas.parent().css('background-color')
        }, time).fadeOut(100);
      },

      animateTitleToCenter: function (fromStateCanvas, toStateCanvas, time) {

      },

      animateCenterToCloudObject: function (source, target, time) {
        var divSource = this.clone(source);
        animationCanvas.append(divSource);

        divSource.css({
          'position': 'absolute',
          'height': source.height(),
          'width': source.width(),
          'margin': 0,
          'left': source.offset().left - canvas.offset().left,
          'top': source.offset().top - canvas.offset().top
        });

        var targetStyles = this.getComputedStyles(target, animationStyles);
        $.extend(targetStyles, {
          'left': target.offset().left - canvas.offset().left,
          'top': target.offset().top - canvas.offset().top,
          'height': target.height(),
          'width': target.width(),
          'margin-left': 0,
          'margin-top': 0,
          'margin-bottom': 0,
          'margin-right': 0
        });

        divSource.animate(targetStyles, { duration: time });

        // Padding
        var divPadding = $('<div />');
        divSource.append(divPadding);

        var paddingTargetStyles = this.getComputedStyles(target.find('.padding'), animationStyles);
        divPadding.animate(paddingTargetStyles, time);

        // Type
        var divType = this.clone(source.find('.type'));
        divPadding.append(divType);

        divType.html(source.find('.type').html());

        var typeTargetStyles = this.getComputedStyles(target.find('.type'), animationStyles);
        divType.animate(typeTargetStyles, time);

        // Title
        var divTitle = this.clone(source.find('.title'));
        divPadding.append(divTitle);

        divTitle.html(source.find('.title').html());

        var titleTargetStyles = this.getComputedStyles(target.find('.title'), animationStyles);
        divTitle.animate(titleTargetStyles, time);
      },

      animateCloudObjectToCenter: function (source, target, time) {
        var divSource = this.clone(source);
        animationCanvas.append(divSource);

        divSource.css({
          'position': 'absolute',
          'height': source.height(),
          'width': source.width(),
          'margin': 0,
          'left': source.offset().left - canvas.offset().left,
          'top': source.offset().top - canvas.offset().top
        });

        var targetStyles = this.getComputedStyles(target, animationStyles);
        $.extend(targetStyles, {
          'left': target.offset().left - canvas.offset().left,
          'top': target.offset().top - canvas.offset().top,
          'height': target.height(),
          'width': target.width(),
          'margin-left': 0,
          'margin-top': 0,
          'margin-bottom': 0,
          'margin-right': 0
        });

        divSource.animate(targetStyles, { duration: time });

        // Padding
        var divPadding = this.clone(source.find('.padding'));
        divSource.append(divPadding);

        var paddingTargetStyles = { "padding-left": 0, "padding-right": 0, "padding-top": 0, "padding-bottom": 0 };
        divPadding.animate(paddingTargetStyles, time);

        // Type
        var divType = this.clone(source.find('.type'));
        divPadding.append(divType);

        divType.html(source.find('.type').html());

        var typeTargetStyles = this.getComputedStyles(target.find('.type'), animationStyles);
        divType.animate(typeTargetStyles, time);

        // Title
        var divTitle = this.clone(source.find('.title'));
        divPadding.append(divTitle);

        divTitle.html(source.find('.title').text());

        var titleTargetStyles = this.getComputedStyles(target.find('.title'), animationStyles);
        divTitle.animate(titleTargetStyles, time);
      },

      getComputedStyles: function (element, styleArray) {
        var styles = {};
        var that = this;

        $.each(styleArray, function (i, style) {
          if (element.css(style) && (style != "background-color" || !isTransparent(element.css(style)))) {
            styles[style] = element.css(style);
          }
        });

        return styles;
      },

      clone: function (source) {
        var div = $('<div />');

        div.css(this.getComputedStyles(source, copyStyles));

        return div;
      },

      oldTransition: function (canvas, fromObject, fromStateCanvas, toObject, toStateCanvas, callback) {
        var that = this;

        //Is there a fromStateCanvas (is null on first draw)
        if (fromStateCanvas) {

          var sourceFrom = fromStateCanvas.find('div.centerobject');
          var targetFrom = toStateCanvas.find('div.title a[rel="' + fromObject.getId() + '"]').closest('li.object');

          var sourceTo = fromStateCanvas.find('li.object a[rel="' + toObject.getId() + '"]').closest('li.object');
          var targetTo = toStateCanvas.find('div.centerobject');

          if (sourceFrom.length > 0) {
            cloneFrom = sourceFrom.clone();
            animationCanvas.append(cloneFrom);

            cloneFrom.css({
              'position': 'absolute',
              'left': sourceFrom.offset().left - canvas.offset().left,
              'top': sourceFrom.offset().top - canvas.offset().top,
              'width': sourceFrom.width(),
              'height': sourceFrom.height()
            });
          }

          if (sourceTo.length > 0) {
            cloneTo = $('<div class="object"/>').html(sourceTo.html());
            animationCanvas.append(cloneTo);
            cloneTo.find('.gradient').remove();
            cloneTo.find('.annotations').remove();
            cloneTo.find('.title').after(targetTo.find('.properties').clone());

            cloneTo.find('.properties .label').css('color', targetTo.find('.properties .label').css('color'));
            cloneTo.find('.properties .value').css('color', targetTo.find('.properties .value').css('color'));
            cloneTo.find('.properties .value a').css('color', targetTo.find('.properties .value a').css('color'));

            cloneTo.find('.properties').css({ overflow: 'hidden', height: 0 });
            cloneTo.css({
              'position': 'absolute',
              'left': sourceTo.offset().left - canvas.offset().left,
              'top': sourceTo.offset().top - canvas.offset().top,
              'width': sourceTo.width(),
              'height': sourceTo.height(),
              'margin': 0
            });
          }

          that.fadeOut(fromStateCanvas, 300, function () { fromStateCanvas.remove(); });
          canvas.animate({ "height": toStateCanvas.outerHeight() }, 300, function () {
            var animationTime = 200;

            if (cloneTo) {
              if (targetTo.length > 0) {
                cloneTo.find('.properties').animate({ height: targetTo.find('.properties').height() });
                cloneTo
                .animate({
                  left: targetTo.offset().left - canvas.offset().left,
                  top: targetTo.offset().top - canvas.offset().top,
                  height: targetTo.outerHeight(),
                  width: targetTo.outerWidth(),
                  border: 0,
                  backgroundColor: '#6e84c0'
                }, { duration: animationTime, easing: 'easeInOutQuad', queue: false });
              }
              else {
                that.fadeOut(cloneTo, 100);
              }
            }

            if (cloneFrom) {
              if (targetFrom.length > 0) {
                cloneFrom.find('.properties').css('overflow', 'hidden').animate({ height: 0 }, animationTime);
                cloneFrom
                .animate({
                  left: targetFrom.offset().left - canvas.offset().left,
                  top: targetFrom.offset().top - canvas.offset().top,
                  height: targetFrom.outerHeight(),
                  width: targetFrom.outerWidth()
                }, { duration: animationTime, easing: 'easeInOutQuad', queue: false })
                .find('.padding').animate({ backgroundColor: '#ffffff' }, animationTime);
              }
              else {
                that.fadeOut(cloneFrom, 100);
              }
            }
            setTimeout(function () {

            }, animationTime);
          });

        }
        else {
          canvas.animate({ "height": toStateCanvas.outerHeight() }, 100, function () {
            toStateCanvas.css('visibility', 'visible');
            that.fadeIn(toStateCanvas, 300);

            //Callback when animation is finished
            if (callback)
              callback();
          });
        }
      },

      fadeIn: function (element, duration, callback) {
        var divFade = $('<div/>');
        var canvas = element.closest('div.visualizer_statecanvas');
        canvas.append(divFade);

        var parent = element.parent();

        var bgcolor;
        while (parent && !bgcolor) {
          if (parent.css('background-color')) {
            bgcolor = parent.css('background-color');
          }
        }

        divFade.css({
          'background-color': bgcolor ? bgcolor : '#fff',
          'position': 'absolute',
          'left': element.offset().left - canvas.offset().left,
          'top': element.offset().top - canvas.offset().top,
          'height': element.outerHeight(),
          'width': element.outerWidth(),
          'z-index': 1000
        });

        divFade.fadeOut(duration, function () {
          divFade.remove();

          if (callback)
            callback();
        });
      },

      fadeOut: function (element, duration, callback) {
        var divFade = $('<div/>');
        var canvas = element.closest('div.visualizer_statecanvas');
        canvas.append(divFade);

        var parent = element.parent();

        var bgcolor;
        while (parent && !bgcolor) {
          if (parent.css('background-color')) {
            bgcolor = parent.css('background-color');
          }
        }

        divFade.css({
          'background-color': bgcolor ? bgcolor : '#fff',
          'position': 'absolute',
          'left': element.offset().left - canvas.offset().left,
          'top': element.offset().left - canvas.offset().left,
          'height': element.outerHeight(),
          'width': element.outerWidth(),
          'z-index': 1000,
          'display': 'none'
        });

        divFade.fadeIn(duration, function () {
          element.hide();
          divFade.remove();

          if (callback)
            callback();
        });
      }
    }
  };
})(jQuery);/*!
 * File: domain/node.js
 * 
 * Copyright 2011  SURFfoundation
 * 
 * This file is part of InContext.
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *     http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * 
 * For more information: http://code.google.com/p/surf-incontext/
 */

(function ($) {
  Visualizer.Node = function (id, externalId) {
    this.id = id;
    this.externalId = externalId;

    this.properties = {};
    this.relations = {};
    this.inverseRelations = {};
    
    this.title = null;
  };

  Visualizer.Node.prototype = {
    id: null,
    externalId: null,
    properties: null,
    relations: null,
    inverseRelations: null,
    aggregate: null,
    isLoaded: false,

    getProperty: function (identifier) {
      return this.properties[identifier];
    },

    getPropertyLabel: function (identifier) {
      if (this.properties[identifier])
        return this.properties[identifier].label;

      return null;
    },

    getPropertyValue: function (identifier) {
      if (this.properties[identifier])
        return this.properties[identifier].value;

      return null;
    },

    getTitle: function() {
      return this.title;
    },
    
    //Returns External ID if available, else normal id
    getId: function () {
      if (this.externalId)
        return this.externalId;
      else
        return this.id;
    }
  };
})(jQuery);

jQuery.noConflict(true); })();

