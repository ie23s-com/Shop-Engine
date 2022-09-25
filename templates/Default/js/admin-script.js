let IE23S_A;
$(function () {
    IE23S_A = {
        modal: M.Modal.init(document.querySelector('#adm-modal-product'),
            {dismissible: false}),
        modalElement: $('#adm-modal-product'),
        modalForm: $('#adm-modal-product').find("form"),
        block: function () {
            this.modalElement.find(".progress").show();
            this.modalForm.find('input').prop('disabled', true);
            this.modalForm.find('button').prop('disabled', true);
            this.modalForm.find('textarea').prop('disabled', true);
        },
        unblock: function () {

            $('#adm-modal-product').find(".progress").hide();
            this.modalForm.find('input').prop('disabled', false);
            this.modalForm.find('button').prop('disabled', false);
            this.modalForm.find('textarea').prop('disabled', false);
        },
        openForm: function () {
            this.modalForm.trigger("reset");
            this.modalElement.find(".error-message").hide();
            this.unblock()
            this.modal.open();
        },
        successAdded: function () {
            IE23S_A.modal.close();
            M.toast({html: 'New product was added!'});
        },
        failed: function (jqXHR) {

            let errorMessage = 'There was a problem with the request, please try again';
            if (jqXHR.responseJSON && jqXHR.responseJSON.text) {
                errorMessage = jqXHR.responseJSON.text;
            }

            IE23S_A.modalElement.find(".error-message").show();
            IE23S_A.modalElement.find(".error-message").html(errorMessage);

            IE23S_A.unblock();
        },
        onAdd: function (event) {
            event.preventDefault();

            $.ajax({
                type: 'POST',
                url: '/api/product',
                dataType: 'json',
                beforeSend: () => this.block(),
                data: this.modalForm.serialize(),
                success: this.successAdded,
                error: this.failed

            });
        },
        productEditFormLoaded: function (result) {
            IE23S_A.unblock();
            IE23S_A.modalForm.find(':input').each(function () {
                let name = $(this).attr('name');
                if (name && result[name])
                    $(this).val(result[name]);
            })
            M.updateTextFields();
            $('select').formSelect();
        },
        editLoad: function (id) {
            $.ajax({
                type: 'GET',
                url: '/api/product',
                dataType: 'json',
                beforeSend: () => this.block(),
                data: 'id=' + id,
                success: this.productEditFormLoaded,
                error: this.failed

            });
        },
        change_button: function (type) {
            if (type === 'create') {
                this.modalForm.find('button[type="submit"]').html('Create');
            } else {
                this.modalForm.find('button[type="submit"]').html('Edit');
            }
        },
        product_add: function () {
            this.change_button('create');
            this.openForm();
            this.modalForm.submit(e => this.onAdd(e));
            this.modalElement.find('button[name="cancel"]').click(() => this.modal.close());
        },
        productEditForm: function (e) {
            this.change_button('edit');
            this.openForm();
            this.block();
            this.editLoad(e);
            this.modalElement.find('button[name="cancel"]').click(() => this.modal.close());
        },
        initCreate: function (e) {
            e.click(() => IE23S_A.product_add());
        },
        initEdit: function (e) {
            e.click(function () {
                IE23S_A.productEditForm($(this).attr('data-id'));
            });
        }
    }
    IE23S_A.initCreate($('.create-product'));
    IE23S_A.initEdit($('.product-edit'));
});
