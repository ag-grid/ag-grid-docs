    <h2 id="reactCellEditing">
        <img src="../images/react_large.png" style="width: 60px;"/>
        React Cell Editing
    </h2>

    <div class="note" style="margin-bottom: 20px">
        <img align="left" src="../images/note.png" style="margin-right: 10px;" />
        <p>This section explains how to utilise ag-Grid Cell Editors using React. You should read about how
            <a href="../javascript-grid-cell-editor/">Cell Editing</a> works in ag-Grid first before trying to
            understand this section.</p>
    </div>

    <p>
        It is possible to provide a React Cell Editor for ag-Grid to use. All of the information above is
        relevant to React Cell Editors. This section explains how to apply this logic to your React component.
    </p>

    <p>
        For an example of React cellEditing, see the
        <a href="https://github.com/ag-grid/ag-grid-react-example">ag-grid-react-example</a> on Github.
        In the example, the 'name' column uses a React Cell Editor.</p>
    </p>

    <h3 id="specifying-a-react-cell-editor"><img src="../images/react_large.png" style="width: 20px;"/> Specifying a React Cell Editor</h3>

    <p>
        If you are using the ag-grid-react component to create the ag-Grid instance,
        then you will have the option of additionally specifying the Cell Editors
        as React components.
    </p>

    <snippet>
// create your Cell Editor as a React component
class NameCellEditor extends React.Component {

    // constructor gets the props
    constructor(props) {
        // set initial state to be the value to be edited
        this.state = {value: props.value};
    }

    render() {
    // put in render logic
        return &lt;input type="text" value={this.state.value}&gt;&lt;/input&gt;;
    }

    // more logic is needed, but enough for now to show the general setup
}

// then reference the Component in your colDef like this
colDef = {

    // instead of cellRenderer we use cellRendererFramework
    cellEditorFramework: NameCellEditor

    // specify all the other fields as normal
    cellRendererFramework: NameCellRenderer     // if you have a React cell renderer
    headerName: 'Name',
    field: 'firstName',
    ...
}</snippet>

    <p>
        By using <code>colDef.cellEditorFramework</code> (instead of <code>colDef.cellEditor</code>) the grid
        will know it's a React component, based on the fact that you are using the React version of
        ag-Grid.
    </p>


    <h3 id="react-props"><img src="../images/react_large.png" style="width: 20px;"/> React Props</h3>

    <p>
        The React component will get the 'Cell Editor Params' as described above as its React Props.
        Therefore you can access all the parameters as React Props.

    <h3 id="react-methods-lifecycle"><img src="../images/react_large.png" style="width: 20px;"/> React Methods / Lifecycle</h3>

    <p>
        All of the methods in the <code>ICellEditor</code> interface described above are applicable
        to the React Component with the following exceptions:
    <ul>
        <li><i>init()</i> is not used. Instead use the React props passed to your Component.</li>
        <li><i>destroy()</i> is not used. Instead use the React <i>componentWillUnmount()</i> method for
            any cleanup you need to do.</li>
        <li><i>getGui()</i> is not used. Instead do normal React magic in your <i>render()</i> method..</li>
    </ul>

    <p>
        All of the other methods (<i>isPopup(), isCancelBeforeStart(), isCancelAfterEnd(), afterGuiAttached()</i> etc)
        should be put onto your React component and will work as normal.
    </p>

    <h3 id="example-cell-editing-using-react-components">Example: Cell Editing using React Components</h3>
    <p>
        Using React Components in the Cell Editors, illustrating keyboard events, rendering, validation and lifecycle events.
    </p>
    <?= example('React Editor Components', 'react-editor', 'react', array( "enterprise" => 1, "exampleHeight" => 390, "showResult" => true, "extras" => array("bootstrap") )); ?>
