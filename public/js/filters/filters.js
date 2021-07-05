
function filtersAjax(category){
    var text=$("#search").val()
    
    var category=$( "#category option:selected" ).val()
    var sort_category=$( "#sort option:selected" ).val()
    var sort_order=$( "#sort option:selected" ).attr("data-order")
     
    console.log("bump"+text+"category"+category)
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    var formData = {
        category:category,
        text:text,
        sort_category:sort_category,
        sort_order:sort_order,
    }
    $.ajax({
        type: "POST",
        url: "categoryFilter",
        data: formData,
        dataType: 'json',
        success: function (data) {
            console.log(data)
     
            $("#searchResultArea").empty()
         
            $("#searchResultArea").append("<h3 class='text-danger'>Sorry but there are no tests in this category</h3>")
            if(data[0]!="undefined"){
                $("#searchResultArea").empty()
                for(i=0;i<data.length;i++){
                 
                    $("#searchResultArea").append("<div class='col-lg-4 col-md-12 mb-4 mb-lg-0'><h1>"+data[i].name+"</h1><form action='test/"+data[i].id+"'><input type='image' class='img-fluid mb-5' style='max-height: 500px;position:relative;'src='http://localhost:8000/storage/images/"+data[i].file_path+"'></form></div>")
                }}
        },
        error: function (data)
                {
                    console.log(data)
                },
    })
}
    $("body").on('click','#filter-button',function () {
    filtersAjax(category)
});

