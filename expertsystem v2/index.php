<!DOCTYPE html>
<html>
<body>
<div>Welcome</div>
<form id="f" action="" method="post" enctype="multipart/form-data">
    <input type="file" id="input" name="input">
    <input type="submit" value="push">
</form>
<div id="r"></div>
<script>
    (function() {
        var house = {
            init: function(config) {
                this.config = config;
                this.foundation();
                this.bindPostEvents();
            }
            ,bindPostEvents: function() {
                this.config.form.addEventListener("submit", this.upload, false);
            },
            foundation: function() {
                var x;
                if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
                    x = new XMLHttpRequest();
                } else {// code for IE6, IE5
                    x = new ActiveXObject("Microsoft.XMLHTTP");
                }
                x.onreadystatechange = function() {
                    if (x.readyState === 4 && x.status === 200) {
                        document.getElementById("r").innerHTML = x.responseText;
                    }
                };
                x.open("GET","select.php");
                x.send();
			},
			upload: function(e) {
				var f = document.getElementById("f");
				var	Fdata = new FormData(f);
				var b;
                var home = house;

                if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
                    b = new XMLHttpRequest();
                } else {// code for IE6, IE5
                    b = new ActiveXObject("Microsoft.XMLHTTP");
                }
                b.open("POST","main.php", true);
                b.onreadystatechange = function() {
                    if (b.readyState === 4 && b.status === 200) {
                        document.getElementById("r").innerHTML = b.responseText;
                        //home.foundation();
                        //document.getElementById("input").value = "";
                    }
                };
                e.preventDefault();
                b.setRequestHeader("enctype", "multipart/form-data");
                b.send(Fdata);		
			},
            resp: function(event) {
                var b;
                var d = "post="+document.getElementById("input").value;
                var home = house;

                if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
                    b = new XMLHttpRequest();
                } else {// code for IE6, IE5
                    b = new ActiveXObject("Microsoft.XMLHTTP");
                }
                b.open("POST","main.php", true);
                b.onreadystatechange = function() {
                    if (b.readyState === 4 && b.status === 200) {
                        document.getElementById("r").innerHTML = b.responseText;
                        home.foundation();
                        document.getElementById("input").value = "";
                    }
                };
                event.preventDefault();
                b.setRequestHeader("enctype", "multipart/form-data");
                b.send(d);
            }
        };
        house.init({
            form: document.getElementById("f")
        });
    })();
</script>
</body>
</html>
