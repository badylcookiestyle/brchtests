$("#searchSubmit").click(function(){
    $('#category option').each(function () {
        if (this.defaultSelected) {
            this.selected = true;
            return false;
        }
    });

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
                    console.log(data)
                    console.log("received")
                },
                success: function (data)
                { console.log(data)
                     var arrayOfTests=data.selectedTests
                     
                    $("main").empty()
                    $("main").append("<div id='searchResultArea' class='container text-center'></div>")
                    $("main").prepend(` <nav class="navbar navbar-light bg-light mx-5">
                     <div class="container-fluid">
                         <span class="navbar-brand mb-0 h1">Filters</span>
                         <select class="form-select form-select-lg" id="category" name="category" aria-label=".form-select-lg example">
                             <option selected>Select category</option>
                             <option value="fitness">fitness</option>
                             <option value="video games">video games</option>
                             <option value="anime">anime</option>
                             <option value="science">science</option>
                             <option value="cooking">cooking</option>
                             <option value="history">history</option>
                             <option value="other">other</option>
                         </select>
                     </div>
                 </nav>`)
                    if(arrayOfTests!=0){
                    for(i=0;i<arrayOfTests.length;i++){
                        $("#searchResultArea").append(" <div class='col-lg-4 col-md-12 mb-4 mb-lg-0'>\
                                        <h1>"+arrayOfTests[i].name+"</h1>\
                                    <form action='test/"+arrayOfTests[i].id+"'>\
                                        <input type='image' class='img-fluid mb-5' style='max-height: 500px;  position: relative;'\
                             src='http://localhost:8000/storage/images/"+arrayOfTests[i].file_path+"' alt='There is no img'>\
                                    </form>\
                                </div>")
                    }}
                    else{
                        $("#searchResultArea").append("<h1 class='text-center text-danger'>This test doesn't exist :/</h1>")
                    }
                },
                
            });
    }
})