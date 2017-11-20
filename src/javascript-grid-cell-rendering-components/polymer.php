<h2 id="polymerCellRendering">
    <img src="../images/polymer-large.png" style="width: 60px;"/>
    Polymer Cell Rendering
</h2>

<div class="note" style="margin-bottom: 20px">
    <img align="left" src="../images/note.png" style="margin-right: 10px;"/>
    <p>This section explains how to utilise ag-Grid cellRenders using Polymer. You should read about how
        <a href="/">Cell Rendering works in ag-Grid</a> first before trying to
        understand this section.</p>
</div>

<p>
    It is possible to provide a Polymer cell renderer's for ag-Grid to use. All of the information above is
    relevant to Polymer cell renderer's. This section explains how to apply this logic to your Polymer component.
</p>

<p>
    For examples on Polymer cellRendering, see the
    <a href="https://github.com/ag-grid/ag-grid-polymer-example">ag-grid-polymer-example</a> on Github.
    Polymer renderer's are used on all but the first Grid on this example page (the first grid uses plain JavaScript
    renderer's)</p>
</p>

<h3 id="specifying-a-polymer-cell-renderer"><img src="../images/polymer-large.png" style="width: 20px;"/> Specifying a
    Polymer Cell Renderer</h3>

<p>
    If you are using the ag-grid-polymer component to create the ag-Grid instance,
    then you will have the option of additionally specifying the cell renderer's
    as Polymer components.

<h3 id="cell-renderers-from-polymer-components"><img src="../images/polymer-large.png" style="width: 20px;"/>
    Cell Renderer's from Polymer Components</h3>
<snippet>
// create your cell renderer as a Polymer component
&lt;dom-module id="square-cell-renderer"&gt;
    &lt;template&gt;
        &lt;span&gt;{{valueSquared}}&lt;/span&gt;
    &lt;/template&gt;

    &lt;script&gt;
        class SquareCellRenderer extends Polymer.Element {
            static get is() {
                return 'square-cell-renderer'
            }

            agInit(params) {
                this.params = params;
                this.value = params.value;
            }

            static get properties() {
                return {
                    value: Number,
                    valueSquared: {
                        type: Number,
                        computed: 'squareValue(value)'
                    }
                };
            }

            squareValue(value) {
                return value * value;
            }
        }

        customElements.define(SquareCellRenderer.is, SquareCellRenderer);
    &lt;/script&gt;
&lt;/dom-module&gt;
    
// then reference the Component in your colDef like this
colDef = {
    {
        headerName: "Square Component",
        field: "value",
        // instead of cellRenderer we use cellRendererFramework
        cellRendererFramework: 'square-cell-renderer'

        // specify all the other fields as normal
        editable:true,
        colId: "square",
        width: 200
    }
}</snippet>

<p>The ag Framework expects to find the <code>agInit</code> method on the created component, and uses it to supply the
    cell <code>params</code>.<p>

<p>
    By using <code>colDef.cellRendererFramework</code> (instead of <code>colDef.cellRenderer</code>) the grid
    will know it's an Polymer component, based on the fact that you are using the Polymer version of
    ag-Grid.
</p>

<p>
    This same mechanism can be to use a Polymer Component in the following locations:
<ul>
    <li>colDef.cellRenderer<b>Framework</b></li>
    <li>colDef.floatingCellRenderer<b>Framework</b></li>
    <li>gridOptions.fullWidthCellRenderer<b>Framework</b></li>
    <li>gridOptions.groupRowRenderer<b>Framework</b></li>
    <li>gridOptions.groupRowInnerRenderer<b>Framework</b></li>
</ul>
In other words, wherever you specify a normal cell renderer, you can now specify a Polymer cell renderer
in the property of the same name excepting ending 'Framework'. As long as you are using the Polymer ag-Grid component,
the grid will know the framework to use is Polymer.
</p>

<h3 id="example-rendering-using-polymer-components">Example: Rendering using Polymer Components</h3>
<p>
    Using Polymer Components in the Cell Renderers
</p>
<?= example('Simple Dynamic Component', 'polymer-dynamic', 'polymer', array("exampleHeight" => 460)) ?>

<h3 id="polymer-methods-lifecycle"><img src="../images/polymer-large.png" style="width: 20px;"/> Polymer Methods /
    Lifecycle</h3>

<p>
    All of the methods in the <code>ICellRenderer</code> interface described above are applicable
    to the Polymer Component with the following exceptions:
<ul>
    <li><i>init()</i> is not used. Instead implement the <code>agInit</code> method.
    </li>
    <li><i>getGui()</i> is not used. Instead do normal Polymer magic in your Component via the Polymer template.</li>
</ul>

<h3 id="handling-refresh"><img src="../images/polymer-large.png" style="width: 20px;"/> Handling Refresh</h3>

<p>
    To handle refresh, implement logic inside the <code>refresh()</code> method inside your component and return true.
    If you do not want to handle refresh, just return false from the refresh method (which will tell the grid you do
    not handle refresh and your component will be destroyed and recreated if the underlying data changes).
</p>

<h3 id="example-rendering-using-more-complex-polymer-components">Example: Rendering using more complex Polymer
    Components</h3>
<p>
    Using more complex Polymer Components in the Cell Renderer's
</p>
<?= example('Richer Dynamic Components', 'polymer-rich-dynamic', 'polymer', array("exampleHeight" => 390) ) ?>

<note>The full <a href="https://github.com/ag-grid/ag-grid-polymer-example">ag-grid-polymer-example</a> repo shows many
    more examples for rendering, including grouped rows, full width renderer's
    and so on, as well as examples on using Polymer Components with both Cell Editor's and Filters
</note>