$(document).ready(function(){
  $("#productType").on('change', function(){
    $(".data").hide();
    $("#" + $(this).val()).fadeIn(700);    
  }).change();
});
 
$("#productType").on('change', function(){
var $selectOption=$('#productType').val();
 
if ($selectOption === "Disc") {
 
    $( "#size" ).rules( "add", {
    required: true,
    number: true,
    min: 1,
    messages: {
    required: "Please, enter size",
    number: "Please, provide the data of indicated type",
    min: "Value must be greater than 0",
    }
    });

    $( "#height" ).rules( "remove" );
    $( "#width" ).rules( "remove" );
    $( "#length" ).rules( "remove" );
    $( "#weight" ).rules( "remove" );
 
} else if ($selectOption === "Book") {
 
  $( "#weight" ).rules( "add", {
    required: true,
    number: true,
    min: 1,
    max: 1001,
  messages: {
    required: "Please, enter weight",
    number: "Please, provide the data of indicated type",
    min: "Value must be greater than 0",
    max: "Value must be less than 1001",
  }
  });
 
  $( "#height" ).rules( "remove" );
  $( "#width" ).rules( "remove" );
  $( "#length" ).rules( "remove" );
  $( "#size" ).rules( "remove" );
 
} else if ($selectOption === "Furniture") {
 
  $( "#height" ).rules( "add", {
    required: true,
    number: true,
    min: 1,
  messages: {
    required: "Please, enter height",
    number: "Please, provide the data of indicated type",
    min: "Value must be greater than 0",
  }
  });
 
  $( "#width" ).rules( "add", {
    required: true,
    number: true,
    min: 1,
  messages: {
    required: "Please, enter width",
    number: "Please, provide the data of indicated type",
    min: "Value must be greater than 0",
  }
  });
 
  $( "#length" ).rules( "add", {
    required: true,
    number: true,
    min: 1,
  messages: {
    required: "Please, enter length",
    number: "Please, provide the data of indicated type",
    min: "Value must be greater than 0",
  }
  });
 
  $( "#size" ).rules( "remove" );
  $( "#weight" ).rules( "remove" );
 
} else {
 
  jQuery('#product_form').validate({
      rules:{
        sku:{
          required:true,
          minlength:3,
          remote: {
              url: "/checkSKU",
              type: "post"
          }
        },
        name:{
          required:true,
          minlength:3,
        },
        price:{
          required:true,
          number: true,
          min: 1,
          max: 100001,
        },
        list:{
          required:true,  
        },
      },messages:{
        sku:{
          required:"Please, enter SKU",
          minlength:"SKU length minimum 3 characters",
          remote: "This SKU alredy exists",
        },
        name:{
          required:"Please, enter name",
          minlength:"Name length minimum 3 characters",
        },
        price:{
          required:"Please, enter price",
          number: "Please, provide the data of indicated type",
          min: "Value must be greater than 0",
          max: "Value must be less than 100 000",
        },
        list:{
          required:"Please, choose product type",
        }
      },
      submitHandler:function(form){
        form.submit();
      }
  });
 
}
});