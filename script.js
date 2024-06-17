/* déclaration variable*/
var valeur = 0
var content
var colonne
var ligne
var carte_1 = ""
var carte_2 = ""
var memoire_carte_1 = ""
var memoire_carte_2 = ""
var liste = []
var compteur = 0
var noclick
var Images = []
var memo_diff
var liste2 = []
var backgroundImage = []

$(document).ready(function () {
    $('#Victoire').hide()


});
/* boutton difficulter choisis, création grille de jeu */
$(".lancer_party").on("click", function () {
    $.ajax({
        type: 'GET',
        url: 'charge_image.php',
        dataType: 'json',
        success: function (data) {
            $.each(data, function (index, base64String) {
                var img = $("<img>").attr({ src: "data:image/jpeg;base64," + base64String, id: "photo" + i });
                $("#storage").append(img);
            });
        },
        error: function (xhr, status, error) {
            console.log(error);
        }
    });



    $("#tableau").hide()


    memo_diff = $(this)
    col_lign = $(this).text().split('X')
    colonne = col_lign[0]
    ligne = col_lign[1]
    /*création tableau de valeur des cases*/
    for (y = 0; y < colonne / 2; y++) {
        for (x = 0; x < ligne; x++) {
            liste.push(valeur)
            liste.push(valeur)
            valeur += 1
        }

    }
    shuffle(liste)
    for (t = 0; t < liste.length; t++) {
        liste2.push(liste[t])
    }

    for (i = 0; i < colonne; i++) {
        content += '<tr>'
        for (x = 0; x < ligne; x++) {
            content += '<td> <div name="' + liste[0] + '"class="flip-card"><div class="flip-card-inner"><div class="flip-card-front"></div><div class="flip-card-back">' + liste[0] + '</div></div></div> </td > '
            liste.shift()
        }
        content += '</tr>'
    }
    $('#grille_jeu').append(content);
    content = ""

    setTimeout(function () {
        $("img[id^=photo]").each(function () {
            backgroundImage.push("url(" + $(this).attr("src") + ")");
        })
        console.log(backgroundImage)
        for (i = 0; i < colonne; i++) {
            for (x = 0; x < ligne; x++) {
                $("div[name=" + liste2[0] + "] .flip-card-back").css("background-image", backgroundImage[liste2[0]])
                $("div[name=" + liste2[0] + "] .flip-card-back").css('background-repeat', 'no-repeat')
                $("div[name=" + liste2[0] + "] .flip-card-back").css('background-size', 'cover')
                liste2.shift()
            }
        }
    }, 500);
})



/* quand on retourne les cartes */
$('#grille_jeu').on('click', '.flip-card-inner', function () {
    if ($(this).parent().hasClass('flip') || noclick == 1) {
    } else {
        $(this).parent().addClass('flip')
        if (carte_1 == "") {
            memoire_carte_1 = $(this).parent()
            carte_1 = $(this).parent().attr("name")
        } else {
            memoire_carte_2 = $(this).parent()
            carte_2 = $(this).parent().attr("name")
            if (carte_1 == carte_2) {
                memoire_carte_1 = ""
                memoire_carte_2 = ""
                carte_1 = ""
                carte_2 = ""
                compteur += 1
                /*verif victoire */
                if (compteur == valeur) {
                    setTimeout(function () {
                        col_lign = 0
                        colonne = 0
                        ligne = 0
                        valeur = 0
                        compteur = 0
                        alert('victoire')
                        $("#Victoire").show()
                        $('#grille_jeu').children().remove()


                    }, 1000);
                }

            } else {
                noclick = 1
                setTimeout(function () {
                    memoire_carte_1.removeClass('flip')
                    memoire_carte_2.removeClass('flip')
                    memoire_carte_1 = ""
                    memoire_carte_2 = ""
                    carte_1 = ""
                    carte_2 = ""
                    noclick = 0
                }, 1000);

            }
        }
    }

})


/*bouton rejouer */
$('#rejouerD').on('click', function () {
    $("#Victoire").hide()
    $("#tableau").show()
    memo_diff = ""
    backgroundImage = []
    $("#storage").empty()
})
$('#rejouer').on('click', function () {
    $("#Victoire").hide()
    memo_diff.trigger("click")
    backgroundImage = []
    $("#storage").empty()

})


/*mélanger le tableau*/
function shuffle(array) {
    let currentIndex = array.length, randomIndex;

    while (currentIndex > 0) {

        randomIndex = Math.floor(Math.random() * currentIndex);
        currentIndex--;

        [array[currentIndex], array[randomIndex]] = [
            array[randomIndex], array[currentIndex]];
    }

    return array;
}