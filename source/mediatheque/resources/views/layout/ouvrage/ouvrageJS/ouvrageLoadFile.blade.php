<script type="text/javascript" async>
    var image = document.getElementById("profil_livre");
    var types = ["image/jpg", "image/jpeg", "image/png"];
    var previewPicture = function(e){
        const [picture] = e.files;
        if (types.includes(picture.type)){
            image_livre.src = URL.createObjectURL(picture);
        }
    }
</script>
