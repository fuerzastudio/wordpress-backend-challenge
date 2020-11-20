jQuery(function ($) {

    $("body").on("click", ".j-fuerza", function (event) {
        event.preventDefault();
        const button = $(this);
        const action = button.data("action");
        const form = button.closest("form").serialize() + "&action=" + action;

        $.ajax({
            url: wp.fuerzaUrl,
            type: "POST",
            data: form,
            beforeSend: () => {

                $('.j-text-errors').remove();

            },
        }).then((resposta) => {

            if (resposta) {

                sendMessage(resposta, button)

            } else {

                alert('several errors, please try again')

            }
        });

    });

    function sendMessage(resposta) {

        const { field, message } = resposta.data

        const item = $(`input[name='${field}']`)
        const itemMessage = $(`.j-${field}`)

        console.log(item, message)

        if (resposta.success) {

            $('body').find('input').val('');

            $('.box-form-fuerza-button').after(` 
              <small class="text-muted j-text-errors pt-4">Sua intenção em participar do curso
              foi enviada, aguarde um momento que vamos te redirecionar para sua inscrição</small>
              `);

            setTimeout(function () {

                setNewClient(resposta.data)

            }, 5000)

        } else {

            itemMessage.append(` <small class="text-muted j-text-errors">${message}</small>`)
        }

    }

    function setNewClient(data) {

        localStorage.setItem('fuerza-cursos:client', JSON.stringify(data))

        window.location.href = `${data.link}`

    }

});


