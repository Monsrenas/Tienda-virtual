 

<div id ="Historias" class=" col-md-12"> <!--- COntenedor principal-->
  <div class="row  clearfix">
    <strong><div id="test_tree">
      
    </div></strong>
  </div>
</div>
<script type="text/javascript">
  
 tree();
  
  
  
 function tree(){ //Funcion que hace el arbol
  var test_tree = [
  {
    text: "Parent 1",
    nodes: [
    {
        text: "Child 1",
    nodes: [
        {
            text: "Grandchild-1",
      nodes: [
        {
         text: "Grandchild 111",
        },
        {
        text: "Grandchild 2",
        }
      ]
          },
        ]
    },
    {
        text: "Child 2",
     state: 
    {
      expanded: true,
    },
    }
    ]
  },

 
];
    
    
  //$('#test_tree').treeview({data: test_tree});
  
  $('#test_tree').treeview({
     expanded: true,
    data: test_tree,  
    levels: 5,
    backColor: 'white',
    color: '#686a10',
    borderColor: 'transparent',
    showBorder:false,
    highlightSelected: false,
    
    
  });
  
  


  
}

</script>