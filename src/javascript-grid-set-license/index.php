<?php
$key = "License Key";
$pageTitle = "ag-Grid JavaScript Data Grid Set License Key";
$pageDescription = "How to set the License Key in ag-Grid Enterprise";
$pageKeyboards = "ag-Grid JavaScript Data Grid Excel License Key";
$pageGroup = "feature";
include '../documentation-main/documentation_header.php';
?>

<div>

    <h2><img src="../images/enterprise_50.png" title="Enterprise Feature"/> Set License</h2>

    <p>
        Set the license key via the JavaScript method as described below.
        ag-Grid checks the license key without making any network calls.
        The license key is set once for the grid library. You do not need to set the license key for each instance of
        ag-Grid that you create. You must set the license key before you create an instance of ag-Grid.
    </p>

    <p>Note that it is crucial that you pass the key exactly as provided by ag-Grid - do not modify the key in any
        way.</p>

    <note>
        If you are distributing your product and including ag-Grid Enterprise, we realise that your license key will be
        visible to others. We appreciate that this is happening and just ask that you don't advertise it. Given our
        product is JavaScript, there is little we can do to prevent this.
    </note>

    <h4><img src="../images/svg/javascript.svg" style="height: 25px" title="JavaScript"/> JavaScript</h4>

    <p>
        Use this if you are using the bundled version of ag-Grid (eg you are using <i>ag-grid-enterprise.js</i>).
    </p>
<snippet>
agGrid.LicenseManager.setLicenseKey("your license key");
</snippet>

    <h4>CommonJS</h4>
    <p>Use this if you are using CommonJS to load ag-Grid.</p>
<snippet>
var enterprise = require("ag-grid-enterprise");
enterprise.LicenseManager.setLicenseKey("your license key");
</snippet>

    <h4>Do Not Mix Loading Mechanisms</h4>

    <p>
        If you mix the methods above (eg if you are using CommonJS in your application, but use the JavaScript approach
        above to set license key) then it will not work. This is because the ag-Grid library will be loaded twice,
        one will have the license key and the other will be used in your application without the license key.
    </p>

    <h3><img src="../images/angular2_large.png" style="height: 25px" title="Angular"/> Angular</h3>

    <p>We recommend setting the license key in your main boot files (typically named either <code>main.ts</code> or
        <code>boot.ts</code>, before you bootstrap your application.</p>

    <p>For example:</p>

<snippet>
import {platformBrowser} from "@angular/platform-browser";
import {AppModuleNgFactory} from "../aot/app/app.module.ngfactory";

import {LicenseManager} from "ag-grid-enterprise/main";
LicenseManager.setLicenseKey("your license key");

platformBrowser().bootstrapModuleFactory(AppModuleNgFactory);
</snippet>

    <h3><img src="../images/react_large.png" style="height: 25px" title="React"/> React</h3>

    <p>We recommend setting the license key in your main bootstrap file (typically named <code>index.js</code>), before
        you
        bootstrap your application.</p>

    <p>For example:</p>

<snippet>
import React from "react";
import {render} from "react-dom";

import "ag-grid-root/dist/styles/ag-grid.css";
import "ag-grid-root/dist/styles/ag-theme-fresh.css";

import {LicenseManager} from "ag-grid-enterprise/main";
LicenseManager.setLicenseKey("your license key");

import App from "./App";

document.addEventListener('DOMContentLoaded', () =&gt; {
render(
&lt;App/&gt;,
document.querySelector('#app')
);
});
</snippet>

    <h3><img src="../images/vue_large.png" style="height: 25px" title="VueJs"/> VueJS</h3>

    <p>We recommend setting the license key in your main bootstrap file (typically named <code>main.js</code>), before
        you
        bootstrap your application.</p>

    <p>For example:</p>

<snippet>
import Vue from "vue";

import "../node_modules/ag-grid/dist/styles/ag-grid.css";
import "../node_modules/ag-grid/dist/styles/ag-theme-fresh.css";

import "ag-grid-enterprise/main";
import {LicenseManager} from "ag-grid-enterprise/main";

LicenseManager.setLicenseKey("your license key");

new Vue({
el: "#el",
...
});
</snippet>

    <h3><img src="../images/polymer-large.png" style="height: 25px" title="Polymer"/> Polymer</h3>

    <p>You have two choices as to where to set your license key in Polymer.</p>

    <p>If you have many components with agGrid in, the we suggest
        you run a separate script to reference and set the license key - for example:</p>

<snippet>
// the main/initial index.html
&lt;script src="../bower_components/ag-grid-enterprise/dist/ag-grid-enterprise.noStyle.js"&gt;&lt;/script&gt;

&lt;!-- ag-grid-polymer element --&gt;
&lt;link rel="import" href="../bower_components/ag-grid-polymer/ag-grid-polymer.html"&gt;

&lt;!-- your code --&gt;
&lt;!-- licenseKey.js will be responsible for setting the license key across the application --&gt;
&lt;script src="licenseKey.js"&gt;&lt;/script&gt;
&lt;link rel="import" href="grid-component-one.html"&gt;
&lt;link rel="import" href="grid-component-one.html"&gt;
</snippet>
<snippet>

// licenseKey.js
agGrid.LicenseManager.setLicenseKey("your license key")
</snippet>

    <p>If you have a single component, or a single component that in turn has the child components, you can set the
        license key
        in this parent component - for example:</p>

<snippet>
// the main/initial index.html
&lt;script src="../bower_components/ag-grid-enterprise/dist/ag-grid-enterprise.noStyle.js"&gt;&lt;/script&gt;

&lt;!-- ag-grid-polymer element --&gt;
&lt;link rel="import" href="../bower_components/ag-grid-polymer/ag-grid-polymer.html"&gt;

&lt;!-- your code --&gt;
&lt;link rel="import" href="main-component-one.html"&gt;
</snippet>

<snippet>
// main-component-one.html
&lt;dom-module id="simple-grid-example"&gt;
&lt;template id="template"&gt;
&lt;div &gt;
&lt;ag-grid-polymer style="width: 100%; height: 350px;"
class="ag-theme-fresh"
rowData="{{rowData}}"
columnDefs="{{columnDefs}}"&gt;&lt;/ag-grid-polymer&gt;
&lt;/div&gt;
&lt;/template&gt;

&lt;script&gt;
agGrid.LicenseManager.setLicenseKey("your license key")

class SimpleGridExample extends Polymer.Element {
...
}
</snippet>

    <h3><img src="../images/aurelia_large.png" style="height: 25px" title="Aurelia"/> Aurelia</h3>

    <p>
        For Aurelia users, we suggest you set your License Key in the <code>configure</code> function, as follows:
<snippet>
export function configure(aurelia: Aurelia) {
    aurelia.use
    .standardConfiguration()
    .plugin('ag-grid-aurelia')
    .feature('resources');

    LicenseManager.setLicenseKey("your license key");

    ...rest of function
</snippet>
</div>

<?php include '../documentation-main/documentation_footer.php'; ?>
