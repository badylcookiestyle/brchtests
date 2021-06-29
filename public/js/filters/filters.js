function categoryAjax(category){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    var formData = {
        category:category
    }
    $.ajax({
        type: "POST",
        url: "categoryFilter",
        data: formData,
        dataType: 'json',
        success: function (data) {
            $(".row").empty()
            console.log(data[0]);
            $(".row").append("<h3 class='text-danger'>Sorry but there are no tests in this category</h3>")
            if(data[0]!="undefined"){
                for(i=0;i<data.length;i++){
                    $(".row").empty()
                    $(".row").append("<div class='col-lg-4 col-md-12 mb-4 mb-lg-0'><h1>"+data[i].name+"</h1><form action='test/"+data[i].id+"'><input type='image' class='img-fluid mb-5' style='max-height: 500px;position:relative;'src='http://localhost:8000/storage/images/"+data[i].file_path+"'></form></div>")
                }}
        },
    })
}
$("#category").change(function() {
    var category=$( "#category option:selected" ).val()
    categoryAjax(category)
});
