$(document).ready(function() {

    function createPost(res) {
        var Parent = $('#postContainer');
        var Post = $("<div class=\"Post\"></div>");
        var name = $("<label></label>");
        var face = $("<img/>");
        var hr = $("<hr>");
        name.text(res.body)
        var Body =  name.text();
        var body = Body.replace(/---/g,"\n");
        body = body.split('\n');
        name.text(res.name);
        face.attr("src",res.face);
        Post.append(face);
        Post.append(name);
        Post.append(hr);
        for(var x = 0; x < body.length; x++){
            if(body[x] == ""){
                
                Post.append($("<br>"));
                var post = $("<p></p>");
                post.text(body[x]);
                Post.append(post);  
            }else{
                alert(body[x]);
                var post = $("<p></p>");
                post.text(body[x]);
                Post.append(post);
            }
            
           
        }
        Parent.append(Post);
    }
    $('.ToPost-Container form button').on('click', function(e) {
        e.preventDefault();
        var xmlhttp = new XMLHttpRequest();
        var Post = $('.ToPost-Container form textarea').val();  
        Post = Post.replace(/\n/g,"---");      
       
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var Parent = $('#postContainer');
                var res = JSON.parse(this.responseText); //JSON.stringify(this.responseText);
                createPost(res);
                $('.ToPost-Container form textarea').val("");
            }

        };
        xmlhttp.open("GET", "controller/PostController.php?post=" + Post, true);
        xmlhttp.send();
        //alert(Post);
    });
});