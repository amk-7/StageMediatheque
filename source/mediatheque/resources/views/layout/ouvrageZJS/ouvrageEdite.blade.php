<script type="text/javascript" async>

    function selectionnerValeur(id_balise_select, valeur){
        let select_attribute = document.getElementById(`${id_balise_select}`);
        let select_attribute_values = select_attribute.options;
        //console.log(valeur);
        // enlever les espace avant la comparaison
        for (let i = 0; i < select_attribute_values.length; i++) {
            if(select_attribute_values[i].value==valeur){
                select_attribute.selectedIndex = select_attribute.options[i].index;
            }
        }
    }

    function removeElt(id_div_elt, id_remove_btn){
        stopPropagation(event);
        let div_elts = document.getElementById(id_div_elt);
        let btn = event.srcElement;
        let input = document.getElementById(id_remove_btn);
        div_elts.removeChild(input);
        div_elts.removeChild(btn);
        // console.log(btn);
        // console.log(input);
    }

    function stopPropagation(event){
        event.preventDefault();
        event.stopPropagation();
    }
</script>
