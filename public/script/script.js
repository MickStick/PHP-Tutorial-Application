$(document).ready(function() {

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
        Post.attr("data-id", res.post_id);
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
    $('.ToPost-Container form button').on('click', function(e) {
        e.preventDefault();
        var xmlhttp = new XMLHttpRequest();
        var Post = $('.ToPost-Container form textarea').val();
        var Pic = "";
        Post = Post.replace(/\n/g, "@@@");

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var Parent = $('#postContainer');
                var res = JSON.parse(this.responseText); //JSON.stringify(this.responseText);
                if (res.message != null) {
                    createPost(res);
                } else {
                    alert(res.body);
                }
                //alert(this.responseText);

                $('.ToPost-Container form textarea').val("");
            }

        };
        xmlhttp.open("POST", "controller/PostController.php?post=" + Post + "&pic=" + Pic, true);
        xmlhttp.send();
        //alert(Post);
    });

    $('#logout').on('click', function(e) {
        e.preventDefault();
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.responseText == null) {
                alert(this.responseText);
            } else {
                window.location = "index.php";
            }

        }
        xmlhttp.open("POST", "controller/Logout.php");
        xmlhttp.send();
    });

    ////////////////////////////////////////// register/login ////////////////////////////////////////////

    $('#goreg').on('click', function(e) {
        window.location = "signup.php";
    });

    $('#golog').on('click', function(e) {
        window.location = "/";
    });

    ////////////////////////////////////////// register validation ///////////////////////////////////////


    function showValErr(parent) {
        var err = $("<p style=\"color: red; position: absolute; margin-top: -30px; margin-left: -20px;\"></p>");
        err.text("*");
        parent.append(err);
    }

    $('#uname').blur(function(e) {
        var parent = $(this).parent();

        if (this.value == "") {
            if (parent.children().length == 1) {
                showValErr(parent);
            }
        } else {
            if (parent.children().length > 1) {
                parent.children('p').remove();
            }
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                var data = this.responseText;
                if (data) {
                    parent.append("<p style=\"color: red; position: absolute; right: 0%; line-height: 1px;\">Username already exists</p>")
                } else {
                    if (parent.children().length > 1) {
                        parent.children('p').remove();
                    }
                }

            }
            xmlhttp.open("GET", "/controller/MainController.php?uname=" + this.value);
            xmlhttp.send();
        }

    });

    $('#lname').blur(function(e) {
        var parent = $(this).parent();
        if (this.value == "") {
            if (parent.children().length == 1) {
                showValErr(parent);
            }
        } else {
            if (parent.children().length > 1) {
                parent.children('p').remove();
            }
        }

        return false;
    });

    $('#fname').blur(function(e) {
        var parent = $(this).parent();
        if (this.value == "") {
            if (parent.children().length == 1) {
                showValErr(parent);
            }
        } else {
            if (parent.children().length > 1) {
                parent.children('p').remove();
            }
        }
        return false;
    });

    $('#email').blur(function(e) {
        var parent = $(this).parent();
        if (this.value == "") {
            if (parent.children().length == 1) {
                showValErr(parent);
            }
        } else {
            if (parent.children().length > 1) {
                parent.children('p').remove();
            }
            var email = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
            if (!email.test(this.value)) {
                parent.append("<p style=\"color: red; position: absolute; right: 0%; line-height: 1px;\">Must enter a valid email</p>")
            } else {
                if (parent.children().length > 1) {
                    parent.children('p').remove();
                }
            }
        }
        return false;
    });

    function showPValMsg(parent){
        parent.append("<p style=\"font-size: 12px;color: red; position: absolute; right: 0%; line-height: 1px;\">Needs: 1 UC letter, 1 LC letter, 1 number, 1 symbol, 8 or more characters, no spaces</p>")
    }

    $('#pword').blur(function(e) {
        var parent = $(this).parent();
        if (this.value == "") {
            if (parent.children().length == 1) {
                showValErr(parent);
            }
        } else {
            if (parent.children().length > 1) {
                parent.children('p').remove();
            }
            pword = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W|_?).{8,}$/;
            if(!pword.test(this.value)){
                showPValMsg(parent);
            }else if(/^(?=.*\s).{0,}$/.test(this.value)){
                showPValMsg(parent);
            }else {          
                if (parent.children().length > 1) {
                    parent.children('p').remove();
                }
            }
        }
        return false;
    });

    $('#rpword').blur(function(e) {
        var parent = $(this).parent();
        if (this.value == "") {
            if (parent.children().length == 1) {
                showValErr(parent);
            }
        } else{
            
            if (parent.children().length > 1) {
                parent.children('p').remove();
            }
            if(this.value != $('#pword').val()){
                parent.append("<p style=\"color: red; position: absolute; right: 0%; line-height: 1px;\">Passwords must be the same</p>")
            }else{
                if (parent.children().length > 1) {
                    parent.children('p').remove();
                }
            }
        }
        return false;
    });

    $('#regBtn').on('click', function(e){
        alert('clicked');
        var inputs = $('.loginForm table tr td input');
        var val = true;
        
        for(var x = 0; x < inputs.length; x++){
            //console.log(inputs[x].parentElement.children.length);
            if(inputs[x].value == "" || inputs[x].parentElement.children.length > 1){
                val = false;
                break;
            }
        }

        if(!val){
            e.preventDefault();
        }
    });

    ////////////////////////////////////////// register validation ///////////////////////////////////////

    ////////////////////////////////////////// register/login ////////////////////////////////////////////

});