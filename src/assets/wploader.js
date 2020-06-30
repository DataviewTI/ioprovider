"use strict";
let mix = require("laravel-mix");

function IOProvider(params = {}) {
  let dep = {
    provider: "node_modules/intranetone-provider/src/",
    sortable: "node_modules/sortablejs/",
    cropper: "node_modules/cropperjs/dist/",
    jquerycropper: "node_modules/jquery-cropper/dist/",
    dropzone: "node_modules/dropzone/dist/",
  };

  this.compile = (IO, callback = () => {}) => {
    mix.styles(
      [
        IO.src.io.vendors +
          "aanjulena-bs-toggle-switch/aanjulena-bs-toggle-switch.css",
        IO.src.css + "helpers/dv-buttons.css",
        IO.src.io.css + "dropzone.css",
        IO.src.io.css + "dropzone-preview-template.css",
        IO.dep.io.toastr + "toastr.min.css",
        IO.src.io.css + "toastr.css",
        IO.src.io.css + "sortable.css",
        dep.cropper + "cropper.css",
        dep.provider + "provider.css",
        IO.dep.io.slimSelect + "slimselect.min.css",
      ],
      IO.dest.io.root + "services/io-provider.min.css"
    );

    mix.babel(
      [
        dep.sortable + "Sortable.min.js",
        IO.src.io.vendors +
          "aanjulena-bs-toggle-switch/aanjulena-bs-toggle-switch.js",
        IO.dep.io.toastr + "toastr.min.js",
        IO.src.io.js + "defaults/def-toastr.js",
        dep.dropzone + "dropzone.js",
        IO.src.io.js + "dropzone-loader.js",
        dep.cropper + "cropper.js",
        dep.jquerycropper + "jquery-cropper.js",
        IO.dep.io.slimSelect + "slimselect.min.js",
        dep.provider + "provider.js",
      ],
      IO.dest.io.root + "services/io-provider-babel.min.js"
    );

    mix.babel(
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
