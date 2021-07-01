$("#searchSubmit").click(function(){
    var searchValue=$("#search").val()
    if(searchValue!=""){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        console.log("sent")
        $.ajax(
            {
                
                url: "search" ,
                type: 'POST',
                dataType: "JSON",
                data: {
                    "text":searchValue
                },
                error: function (data)
                {
                    console.log("received")
                },
                success: function (data)
                {
                     var arrayOfTests=data.selectedTests
                     
                    $("main").empty()
                    if(arrayOfTests!=0){
                    for(i=0;i<arrayOfTests.length;i++){
                        $("main").append(" <div class='col-lg-4 col-md-12 mb-4 mb-lg-0'>\
                                        <h1>"+arrayOfTests[i].name+"</h1>\
                                    <form action='test/"+arrayOfTests[i].id+"'>\
                                        <input type='image' class='img-fluid mb-5' style='max-height: 500px;  position: relative;'\
                             src='http://localhost:8000/storage/images/"+arrayOfTests[i].file_path+"' alt='There is no img'>\
                                    </form>\
                                </div>")
                    }}
                    else{
                        $("main").append("<h1 class='text-center'>Test not found :/</h1>")
                    }
                },
                
            });
    }
})