window.onload = function () {

    let params = getParams()
    const logNode = document.querySelector('.js-log');

    ajaxRequest(1);

    /**
     * Отправляет AJAX запрос
     *
     * @param offset
     */
    function ajaxRequest(offset) {
        BX.ajax.runComponentAction('custom:iblock',
            'addElement', {
                mode: 'class',
                data: {
                    params: {
                        IBLOCK: params.IBLOCK,
                        apikey: params.apikey,
                        STEP: params.STEP ??= null,
                        COUNT: params.COUNT ??= null,
                        OFFSET: offset
                    }
                },
            })
            .then(function (response) {
                if (response.status === 'success') {

                    if (response.data.OFFSET > params.COUNT) {
                        render(response.data.ELEMENTS)
                    } else {

                        if (response.data.ERROR) {
                            logNode.innerHTML += `
                                <div>${response.data.ERROR}</div>
                            `;
                        } else {
                            render(response.data.ELEMENTS)
                            ajaxRequest(response.data.OFFSET)
                        }

                    }

                } else {
                    console.log(response)
                }
            });
    }

    /**
     * Возвращает get-параметры
     *
     * @returns {{}}
     */
    function getParams() {
        let paramsUrl = window.location.search;
        let result = {};

        paramsUrl = paramsUrl.substring(1).split("&");

        for (let i = 0; i < paramsUrl.length; i++) {
            let temp = paramsUrl[i].split("=");
            result[temp[0]] = temp[1];
        }
        return result
    }

    /**
     * Отображает добавленные элементы
     *
     * @param elements
     */
    function render(elements) {

        elements.forEach(element => {
            logNode.innerHTML += `
                <div>Добавлен новый элемент с id = ${element}</div>
            `;
        })
    }

}
