document.addEventListener('DOMContentLoaded',evt => {
    let bat = document.querySelector("#filter-search > div.fitler_checkbox > input[type=submit]")
    bat.addEventListener('click',ev => {
        let ids = [];
        let form = document.querySelector("#filter-search > div.fitler_checkbox")
        for (const child of form .children){
            for (const childOfChild of child.children){
                if (childOfChild.checked){
                    ids.push(childOfChild.value)
                }
            }
        }
        let idss = {
            genre: ids
        }
        const params = {
            method: 'POST',
            body: JSON.stringify(idss),
            headers: {
                'Content-Type': 'application/json'

            }
        };
        let request = fetch('../php/filter_author_api.php', params);
        request.then(value => {
            value.json().then(value1 => {
                console.log(value1)
                let mults = document.querySelector("#filter-box > div.mult-block")
                mults.innerHTML = '';
                value1.forEach(item => {
                    createNewMult(item);
                })
            })
        })
    })
});


function createNewMult(row){
    let divMult = document.createElement('div');
    divMult.className = 'mult';

    //-----------------------Image------------------------

    let preview = document.createElement('div');
    preview.className = 'mult_img';
    let linkPage = document.createElement('a');
    linkPage.href = 'authors.php?id=' + row['id автора'];
    let image = document.createElement('img');
    image.src = '../img/Authors/' + row['Изображение'];
    linkPage.appendChild(image);
    preview.appendChild(linkPage);

    //----------------------Description-------------------

    let container = document.createElement('div');
    let opis = document.createElement('div');
    opis.className = 'mult_opis';
    opis.innerText = row['Фамилия'] +" "+ row['Имя'];

    container.appendChild(opis);
    divMult.appendChild(preview);
    divMult.appendChild(container);

    document.querySelector("#filter-box > div.mult-block")  .appendChild(divMult)
}