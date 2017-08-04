
$(document).ready(function() {
    fetch();
    function fetch() {
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var Parent = $('#postContainer');
               var res = JSON.parse(this.responseText); //JSON.stringify(this.responseText);
                if(res[0].message != null){
                    for(var x = 0; x < res.length; x++){
                        createPost(res[x]);
                    }
                    
                }else{
                    alert(res[0].body);
                }
                //alert(this.responseText);
                //$('.ToPost-Container form textarea').val(res[0].message);
            }

        }
        xmlhttp.open("GET", "controller/PostController.php?type=0", true);
        xmlhttp.send();
        //alert(Post);
    };
    
        function createPost(res) {
            var Parent = $('#postContainer');
            var delBtn = $("<button><i class=\"material-icons\">delete</i><button>");
            var editBtn = $("<button><i class=\"material-icons\">mode_edit</i><button>");
            var Post = $("<div class=\"Post\"></div>");
            Post.append(delBtn);
            Post.append(editBtn);
            var name = $("<label></label>");
            var date = $("<label></label>");
            var face = $("<img/>");
            var hr = $("<hr>");
            //name.text(res.body)
            var Body = "" + res.body + "";
            var body = Body.replace(/@@@/g, "\n");
            body = body.split('\n');
            name.text(res.name);
            date.text(res.date);
            face.attr("src", res.face);
            Post.attr("data-id",res.post_id);
            Post.append(face);
            Post.append(name);
            Post.append(date);
            Post.append(hr);
            for (var x = 0; x < body.length; x++) {
                if (body[x] == "") {
    
                    Post.append($("<br>"));
                    var post = $("<p></p>");
                    post.text(body[x]);
                    Post.append(post);
                } else {
                    var post = $("<p></p>");
                    post.text(body[x]);
                    Post.append(post);
                }
    
    
            }
            Parent.prepend(Post);
        }
    });
