/// Scatter.js - a lightweight ajax library for element scattering
/// http://quplo.com/scatter
///
/// Copyright (c) 2009
/// Q42 Internet B.V.
/// Written by Martin Kool
///
/// Scatter sends a form (or retrieves a URL) through ajax. If the response contains 
/// elements (at top level) with ids that correspond with ids on the current page, 
/// the current element will be replaced. This is called "scattering" of elements.
///
/// Scatter is a 100% RESTful ajax library with only a 2k footprint, when compressed.
/// It supports forms with multiple submit buttons, several ways of initialization and
/// a clean API. The source code provides Visual Studio intellisense when used in VS.
///
/// Usage:  
///
/// 1. You can specify a rel="scatter" attribute on a form or hyperlink. You only need to
///    run Scatter.scanPage() once, when the page is loaded. This can be done through
///    <body onload="Scatter.scanPage">, or any other way you prefer.
///
/// 2. Another usage is through event handlers on the form element or link, as follows:
///    <form onsubmit="Scatter.send(event)"> or 
///    <a href="..." onclick="Scatter.send(event)">
///
/// 3. Or, you could use the Scatter API directly:
///    Scatter.get("/my-url?foo=bar");
///    Scatter.post("/my-url", "?foo=bar");
///    Scatter.delete("/my-url", "?foo=bar");
///    Scatter.put("/my-url", "?foo=bar");
///    Scatter.submit(myForm);
///
///    All these API calls have an optional last parameter in which you can specify
///    your own handler. Check the method documentation below for details.
(function() {
  var ie = (navigator.appName == "Microsoft Internet Explorer"),
  s = window.Scatter =
  {
    scanPage: function(root) {
      /// <summary>Scans the page for forms and hyperlinks containing a rel="scatter" attribute,
      /// and makes them scatter asynchronoysly on submit (forms) or click (links).</summary>    
      /// <param name="root">The root element to scan. Default is document.body</param>
      function check(el) {
        if (el.getAttribute("rel") == "scatter") {
          var isA = el.nodeName == "A";
          s.attach(el, isA ? "click" : "submit", s.send);
          if (!isA) addButtonDetection(el);
        }
      }
      function addButtonDetection(form) {
        for (var i = 0, els = form.elements, l = els.length; i < l; i++) {
          if (els[i].type == "submit")
            s.attach(els[i], "click", function(event) { event[ie ? "srcElement" : "target"].clicked = 1; });
        }
      }
      if (!root) root = document.body;
      check(root);
      for (var type in { "form": 1, "a": 1 })
        for (var i = 0, els = root.getElementsByTagName(type); i < els.length; i++)
        check(els[i]);
    },

    send: function(event) {
      /// <summary>Sends a form or url request by ajax, scatters its html 
      /// on the current page and cancels the submit or click event.</summary>
      /// <param name="event">The onsubmit or onclick event</param>
      var el = ie ? event.srcElement : event.target;
      if (el.tagName == "FORM") s.submit(el);
      if (el.tagName == "A") s.get(el.getAttribute("href"));
      ie ? event.returnValue = false : event.preventDefault();
    },

    xhr: function(method, url, ps, h) {
      /// <summary>Performs an ajax request and scatters the results.</summary>
      /// <param name="method">The http method to use</param>
      /// <param name="url">The url to request through ajax</param>
      /// <param name="ps">The data to send</param>
      /// <param name="h">Optional request handler, default is Scatter.scatter</param>
      if (!h) h = s.scatter;
      var xhr = ie ? new ActiveXObject("Microsoft.XmlHttp") : new XMLHttpRequest();
      xhr.open(method, url, true);
      if (method == "post") xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      else {
        url += ((url.indexOf("?") < 0) ? "?" : "&") + ps;
        ps = null;
      }
      if (ps) xhr.setRequestHeader("Content-length", ps.length);
      xhr.onreadystatechange = function() { if (xhr.readyState == 4) h(xhr); }
      xhr.send(ps);
    },

    "get": function(url, ps, h) {
      /// <summary>Performs a GET request to the specific url, and scatters the results.</summary>
      /// <param name="url">The url to request through ajax</param>
      /// <param name="ps">The data to send</param>
      /// <param name="h">Optional request handler, default is Scatter.scatter</param>
      s.xhr("get", url, ps, h);
    },

    post: function(url, ps, h) {
      /// <summary>Performs a POST request to the specific url, and scatters the results.</summary>
      /// <param name="url">The url to request through ajax</param>
      /// <param name="ps">The data to send</param>
      /// <param name="h">Optional request handler, default is Scatter.scatter</param>
      s.xhr("post", url, ps, h);
    },

    put: function(url, ps, h) {
      /// <summary>Performs a PUT request to the specific url, and scatters the results.</summary>
      /// <param name="url">The url to request through ajax</param>
      /// <param name="ps">The data to send</param>
      /// <param name="h">Optional request handler, default is Scatter.scatter</param>
      s.xhr("put", url, ps, h);
    },

    "delete": function(url, ps, h) {
      /// <summary>Performs a DELETE request to the specific url, and scatters the results.</summary>
      /// <param name="url">The url to request through ajax</param>
      /// <param name="ps">The data to send</param>
      /// <param name="h">Optional request handler, default is Scatter.scatter</param>
      s.xhr("delete", url, ps, h);
    },

    submit: function(form, h) {
      /// <summary>Submits a form by ajax, and scatters its results.</summary>
      /// <param name="form">The form element to submit</param>
      /// <param name="h">Optional request handler, default is Scatter.scatter</param>
      var ps = "", i = 0, el, value;
      for (; el = form.elements[i++]; ) {
        if (!el.name) continue;
        value = escape(el.value);
        switch (true) {
          case el.type == "submit" && !el.clicked:
            continue;
          case el.type == "radio" && !el.checked:
          case el.type == "checkbox" && !el.checked:
            continue;
          case el.type == "submit":
            el.clicked = undefined;
          default:
            ps += ((ps == "") ? "" : "&") + el.name + "=" + value;
        }
      }
      var attrs = form.attributes,
          method = attrs.method ? attrs.method.nodeValue.toLowerCase() : "get",
          a = attrs.action, av = a ? a.nodeValue : 0,
          url = av ? av : document.location;
      s.xhr(method, url, ps, h);
    },

    scatter: function(xhr) {
      /// <summary>Scatters all elements in the xhr's response that have a 
      /// corresponding id on the current page. Scripts are executed afterwards.</summary>
      /// <param name="xhr">The XMLHttpRequest object</param>
      function swap(el, newEl) {
        el.style.display = "none";
        el.parentNode.insertBefore(newEl, el);
        el.parentNode.removeChild(el);
        s.scanPage(newEl);
      }
      var script = "",
          els = [],
          html = xhr.responseText.replace(/<script[^>]*?>([^<]*?)<\/script>/gim,
                 function(a, b, c) { script += b; return ""; }),
          temp = document.createElement("div"),
          child, i, l, targetEl, id;

      temp.innerHTML = html.replace(/^<[!|?].*?>[\n|\r]*/, "");
      for (i = 0, l = temp.childNodes.length; i < l; i++)
        els.push(temp.childNodes[i]);
      for (i = 0; i < l; i++) {
        child = els[i];
        if (child.nodeType == 1) {
          id = child.getAttribute("id");
          if (id) {
            targetEl = document.getElementById(id);
            if (targetEl) swap(targetEl, child);
          }
        }
      }
      eval(script);
    },

    attach: function(el, name, h) {
      /// <summary>Adds eventlistener h to el on the named event.</summary>
      /// <param name="el">The element to add the listener to</param>
      /// <param name="name">The eventName, such as "click"</param>
      /// <param name="h">The handler</param>
      ie ? el.attachEvent("on" + name, h) : el.addEventListener(name, h, false);
    }
  };
})();