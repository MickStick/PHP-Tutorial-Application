$(document).ready(function() {
    
    if(window.location.pathname == "/profile.php"){
        fetch();
    }else if(/peopleProfile.php?/.test(window.location.pathname)){
        fetchPeoplePosts();
    }

    $('#settings').on('click', function(e) {
        e.preventDefault();
        $('#settings-list').animate({ height: 'toggle' }, 250);

    });
    
    $('.ToPost-Container form textarea').emojiPicker({
          height: '300px',
          width:  '450px',
          iconBackgroundColor: "transparent",
          button: false
    });
    
    $('#emojiBtn').click(function(e){
        e.preventDefault();
        $('.ToPost-Container form textarea').emojiPicker('toggle');
    });
    
    //$('.ToPost-Container form textarea').emojiPicker('toggle');

    function openEdit() {
        $('html').css({ "overflow-y": "hidden" });
        $('.edit-wrapper').animate({ opacity: 'toggle' }, 300);

    }

    $('#edit-profile').on('click', function(e) {
        e.preventDefault();
        $('#settings-list').animate({ height: 'toggle' }, 250);
        openEdit();
    });

    $('.edit-container > button').on('click', function(e) {
        $('.edit-wrapper').animate({ opacity: 'toggle' }, 300, function() {
            $('html').css({ "overflow-y": "initial" });
        });

    });

    $('.edit-container form input[type=file]').on('change', function() {
        var filename = $(this).val().replace(/([^\\]*\\)*/, '');
        var pngExt = /^[A-Za-z0-9\W_]+.png$/;
        var jpgExt = /^[A-Za-z0-9\W_]+.jpg$/;
        var JPGExt = /^[A-Za-z0-9\W_]+.JPG$/;
        var jpegExt = /^[A-Za-z0-9\W_]+.jpeg$/;
        if (pngExt.test(filename) || jpgExt.test(filename) || JPGExt.test(filename) || jpegExt.test(filename)) {
            PreviewImage(this);
            $('#edit-pic').attr("alt", filename);
        } else if (this.value == "" || this.value == null) {

            $('#edit-pic').attr("src", "");
            $('#edit-pic').attr("alt", " ");
        } else {
            alert("Invalid extension: You may only upload \".png\" or \".jpg\" or \".JPG\" or \".jpeg\" files");
            $(this).contents(null);
        }
    });

    function PreviewImage(file) {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(file.files[0]);

        oFReader.onload = function(oFREvent) {
            $('#edit-pic').attr("src", oFREvent.target.result);
        };
    };
    
    function fetch() {
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var Parent = $('#postContainer');
               var res = JSON.parse(this.responseText); //JSON.stringify(this.responseText);
                if(res[0].message != null){
                    for(var x = 0; x < res.length; x++){
                        createPost(res[x], false);
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
    }
    
    
    function fetchPeoplePosts(){
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var Parent = $('#postContainer');
                var res = JSON.parse(this.responseText); 
            //     res.sort(function(a,b){
            //       console.log(new Date(a.date) > new Date(b.date));
            //   });
                if(res[0].message != null){
                    for(var x = 0; x < res.length; x++){
                        createPost(res[x], true);
                    }
                    
                }else{
                    alert(res[0].body);
                }
                //alert(this.responseText);
                //$('.ToPost-Container form textarea').val(res[0].message);
            }

        }
        xmlhttp.open("GET", "controller/PostController.php?type=2", true);
        xmlhttp.send();
        //alert(Post);
    }

    function createPost(res, pchk) {
        var Parent = $('#postContainer');
        var delBtn = $("<button id=\"delPost\"><i class=\"material-icons\">delete</i></button>");
        var editBtn = $("<button id=\"editPost\"><i class=\"material-icons\">mode_edit</i></button>");
        var Post = $("<div class=\"Post\"></div>");
        if(!pchk){
            Post.append(delBtn);
            Post.append(editBtn);
        }
        
        delBtn.click(function(e){
            e.preventDefault();
           var parent = $(this).parent();
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var res = JSON.parse(this.responseText); //JSON.stringify(this.responseText);
                    
                    if (res[0].message != null) {
                        parent.remove();
                    } else {
                        alert(res[0].body);
                    }
                }
    
            };
            xmlhttp.open("DELETE", "controller/PostController.php?pid=" + parent.attr("data-id"), true);
            xmlhttp.send();
        });
        editBtn.click(function(e){
            e.preventDefault();
            $(this).attr("disabled","true");
            var parent = $(this).parent();
            var oldPost = parent.children('div');
            
            var editPost = $("<textarea class=\"EditPost\"></textarea>");
            for(var x = 0; x < oldPost.children('p').length; x++){
                if(x == 0){
                    editPost.val(editPost.val() + oldPost.children('p')[x].innerHTML);
                }else{
                    editPost.val(editPost.val() + "\n" + oldPost.children('p')[x].innerHTML);
                }
                
            }
            
            editPost.insertAfter(parent.children('div'));
            parent.children('div').remove();
            var upBtn = $("<button id=\"upPost\"><i class=\"material-icons\">mode_edit</i></button>");
            upBtn.insertAfter(parent.children('.EditPost'));
            $("<hr id=\"edit-hr\" />").insertAfter(upBtn);
            upBtn.click(function(e){
                e.preventDefault();
                var parent = $(this).parent();
                var btn = $(this);
                var xmlhttp = new XMLHttpRequest();
                var body =  parent.children('.EditPost').val().replace(/\n/g, "@@@");
                body = body.replace(/'/g,"\''");
                //alert(body);
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var res = JSON.parse(this.responseText); //JSON.stringify(this.responseText);
                        if(res.message != null) {
                            oldPost.children().remove();
                            //console.log(oldPost.innerHTML);
                            
                            btn.remove();
                            body = body.replace(/@@@/g, "\n");
                            body = body.replace(/''/g,"\'");
                            body = body.split('\n');
                            for (var x = 0; x < body.length; x++) {
                                if (body[x] == "") {
                    
                                    oldPost.append($("<br>"));
                                    var post = $("<p></p>");
                                    post.text(body[x]);
                                    oldPost.append(post);
                                } else {
                                    var post = $("<p></p>");
                                    post.text(body[x]);
                                    oldPost.append(post);
                                }
                    
                    
                            }
                            oldPost.insertAfter(parent.children('.EditPost'));
                            parent.children('.EditPost').remove();
                            parent.children('#editPost').removeAttr("disabled");
                            parent.children('edit-hr').remove();
                            //alert(res.message);
                        } else {
                            alert(res.body);
                        }
                        //alert(this.responseText);
                    }
        
                };
                xmlhttp.open("POST", "controller/PostController.php?pid=" + parent.attr("data-id") + "&post=" + body, true);
                if(parent.children('.EditPost').val() == "" || parent.children('.EditPost').val() == null || !/\S+/.test(parent.children('.EditPost').val())){
            
                }else{
                    xmlhttp.send();
                }
                
            });
        });
        var name = $("<label></label>");
        var date = $("<label></label>");
        var face = $("<img/>");
        var hr = $("<hr>");
        //name.text(res.body)
        var Body = "" + res.body + "";
        var body = Body.replace(/@@@/g, "\n");
         body = body.replace(/''/g,"\'");
        body = body.split('\n');
        Body = $('<div style=\"width:100%; height: auto\"></div>');
        name.text(res.name);
        DATE = new Date(res.date);
        //alert(DATE);
        date.text(res.date);
        face.attr("src", res.face);
        Post.attr("data-id", res.post_id);
        Post.append(face);
        Post.append(name);
        Post.append(date);
        Post.append(hr);
        for (var x = 0; x < body.length; x++) {
            if (body[x] == "") {

                Body.append($("<br>"));
                var post = $("<p></p>");
                post.text(body[x]);
                Body.append(post);
            } else {
                var post = $("<p></p>");
                post.text(body[x]);
                Body.append(post);
            }


        }
        if(/\S+/.test(Body.text())){
            Post.append(Body);
        }
        
        if(/\S+/.test(res.pic)){
            var pic = $("<img src=\""+res.pic+"\"/>");
            Post.append(pic);
        }
        Parent.prepend(Post);
    }
    $('#makePost').on('click', function(e) {
        e.preventDefault();
        var xmlhttp = new XMLHttpRequest();
        var Post = $('.ToPost-Container form textarea').val();
        
        if(Post == "" || Post == null || !/\S+/.test(Post)){
            if($('#photo_posts')[0].files[0] != null){
                Post = Post.replace(/\n/g, "@@@");
                Post = Post.replace(/'/g,"\''");
                //alert(Post);
                //$('.ToPost-Container form textarea').val($('.ToPost-Container form textarea').val().replace(/\n/g,"@@@"));
                var formData = new FormData();
                
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var Parent = $('#postContainer');
                        var res = JSON.parse(this.responseText); //JSON.stringify(this.responseText);
                        if (res.message != null) {
                            createPost(res, false);
                        } else {
                            alert(res.body);
                        }
                        //alert(this.responseText);
        
                        $('.ToPost-Container form textarea').val("");
                        $(this).parent().childrne('div').html('');
                        $(this).parent().childrne('div').text('');
                        $(this).parent().childrne('div').val('');
                        document.getElementByClassName("emoji-wysiwyg-editor").innerHTML = "";
                        document.getElementByClassName("emoji-wysiwyg-editor").value = "";
                    }
        
                };
                xmlhttp.open("POST", "controller/PostController.php", true);
                formData.append('body', Post);
                formData.append('file',$('#photo_posts')[0].files[0]);
                xmlhttp.send(formData); 
            }
            
        }/*else if(){
            alert(Post);
        }*/else{
            Post = Post.replace(/\n/g, "@@@");
            Post = Post.replace(/'/g,"\''");
            //alert(Post);
            //$('.ToPost-Container form textarea').val($('.ToPost-Container form textarea').val().replace(/\n/g,"@@@"));
            var formData = new FormData();
            
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var Parent = $('#postContainer');
                    var res = JSON.parse(this.responseText); //JSON.stringify(this.responseText);
                    if (res.message != null) {
                        createPost(res, false);
                    } else {
                        alert(res.body);
                    }
                    //alert(this.responseText);
    
                    $('.ToPost-Container form textarea').val("");
                }
    
            };
            xmlhttp.open("POST", "controller/PostController.php", true);
            formData.append('body', Post);
            if($('#photo_posts')[0].files[0] != null){
                formData.append('file',$('#photo_posts')[0].files[0]);
            }
            xmlhttp.send(formData);   
        }
        //alert(Post);
    });
    
     $('#photo_posts').on('change', function() {
        var filename = $(this).val().replace(/([^\\]*\\)*/, '');
        var pngExt = /^[A-Za-z0-9\W_]+.png$/;
        var jpgExt = /^[A-Za-z0-9\W_]+.jpg$/;
        var JPGExt = /^[A-Za-z0-9\W_]+.JPG$/;
        var jpegExt = /^[A-Za-z0-9\W_]+.jpeg$/;
        if (pngExt.test(filename) || jpgExt.test(filename) || JPGExt.test(filename) || jpegExt.test(filename)) {
            /*PreviewImage(this);
            $('#edit-pic').attr("alt", filename);*/
        } else if (this.value == "" || this.value == null) {

           /* $('#edit-pic').attr("src", "");
            $('#edit-pic').attr("alt", " ");*/
        } else {
            alert("Invalid extension: You may only upload \".png\" or \".jpg\" or \".JPG\" or \".jpeg\" files");
            $(this).contents(null);
        }
    });

    $('#logout').on('click', function(e) {
        $('#settings-list').animate({ height: 'toggle' }, 250);
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

    function showPValMsg(parent) {
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
            if (!pword.test(this.value)) {
                showPValMsg(parent);
            } else if (/^(?=.*\s).{0,}$/.test(this.value)) {
                showPValMsg(parent);
            } else {
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
        } else {

            if (parent.children().length > 1) {
                parent.children('p').remove();
            }
            if (this.value != $('#pword').val()) {
                parent.append("<p style=\"color: red; position: absolute; right: 0%; line-height: 1px;\">Passwords must be the same</p>")
            } else {
                if (parent.children().length > 1) {
                    parent.children('p').remove();
                }
            }
        }
        return false;
    });

    $('#regBtn').on('click', function(e) {
        alert('clicked');
        var inputs = $('.loginForm table tr td input');
        var val = true;

        for (var x = 0; x < inputs.length; x++) {
            //console.log(inputs[x].parentElement.children.length);
            if (inputs[x].value == "" || inputs[x].parentElement.children.length > 1) {
                val = false;
                break;
            }
        }

        if (!val) {
            e.preventDefault();
        }
    });

    ////////////////////////////////////////// register validation ///////////////////////////////////////

    ////////////////////////////////////////// register/login ////////////////////////////////////////////
    
    //////////////////////////////////////////// Add Friend //////////////////////////////////////////////
    $('#addFriend').on('click', function(e){
            var parent = $(this).parent();
            var fid = parent.attr("data-id");
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                var data = this.responseText;
                if (data != null) {
                   parent.children('button').remove();
                   parent.append($("<label>Pending <i class=\"material-icons\">watch_later</i></label>"));
                } else {
                    alert("failed");
                }
                }

            }
            xmlhttp.open("POST", "/controller/AddFriend.php?fid=" + fid + "&type=add");
            xmlhttp.send();
    });
    //////////////////////////////////////////// Add Friend //////////////////////////////////////////////

});