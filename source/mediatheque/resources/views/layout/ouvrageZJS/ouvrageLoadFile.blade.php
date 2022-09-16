<script type="text/javascript" async>
    var image = document.getElementById("profil_object");
    var types = ["image/jpg", "image/jpeg", "image/png"];
    var previewPicture = function(e){
        const [picture] = e.files;
        if (types.includes(picture.type)){
            profil_object.src = URL.createObjectURL(picture);
        }
    }
</script>
