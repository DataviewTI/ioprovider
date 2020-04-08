"use strict";
let mix = require("laravel-mix");

function IOProvider(params = {}) {
  let dep = {
    provider: "node_modules/intranetone-provider/src/",
    // selectPure: "node_modules/select-pure/dist/",
    slimSelect: "node_modules/slim-select/dist/",
  };

  this.compile = (IO, callback = () => {}) => {
    mix.styles(
      [
        IO.src.io.vendors +
          "aanjulena-bs-toggle-switch/aanjulena-bs-toggle-switch.css",
        IO.dep.io.toastr + "toastr.min.css",
        IO.src.io.css + "toastr.css",
        // IO.src.css + "select-pure.css",
        dep.provider + "provider.css",
        dep.slimSelect + "slimselect.min.css",
      ],
      IO.dest.io.root + "services/io-provider.min.css"
    );

    mix.babel(
      [
        IO.src.io.vendors +
          "aanjulena-bs-toggle-switch/aanjulena-bs-toggle-switch.js",
        IO.dep.io.toastr + "toastr.min.js",
        IO.src.io.js + "defaults/def-toastr.js",
        dep.provider + "provider.js",
        // dep.selectPure + "bundle.min.js",
        dep.slimSelect + "slimselect.min.js",
      ],
      IO.dest.io.root + "services/io-provider-babel.min.js"
    );

    mix.scripts(
      [
        IO.dep.jquery_mask + "jquery.mask.min.js",
        IO.src.js + "extensions/ext-jquery.mask.js",
      ],
      IO.dest.io.root + "services/io-provider-mix.min.js"
    );

    callback(IO);
  };
}

module.exports = IOProvider;
