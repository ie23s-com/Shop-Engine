let IE23S_A;
$(function () {
    IE23S_A = {
        modal: M.Modal.init(document.querySelector('#adm-modal-product'),
            {dismissible: false}),
        modalElement: $('#adm-modal-product'),
        modalForm: $('#adm-modal-product').find("form"),
        productsTable: $('#adm-product-list'),
        ajaxSearching: null,
        isEdit: false,
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
            IE23S_A.runSearch('');
        },
        successEdited: function () {
            IE23S_A.modal.close();
            M.toast({html: 'New product was edited!'});
            IE23S_A.runSearch('');
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
        successSearch: function (result) {

            IE23S_A.isSearching = false;

            $.each(result, function (key, value) {
                let tr = $('#adm-product-template').find('tbody').html();

                let replace = {
                    id: value.id,
                    display_name: value.display_name,
                    category: value.category_name,
                    cost: value.cost,
                    description: value.description,
                    art: value.art,
                    code: value.code,
                    sold: value.sold,
                    balance: value.balance
                }
                Object.keys(replace).forEach(function (key) {

                    tr = tr.replaceAll('\{' + key + '\}', replace[key]);

                });
                IE23S_A.productsTable.find('tbody').append(tr);
            });
            IE23S_A.initEdit($('.product-edit'));

            IE23S_A.initRemove($('.product-remove'));
            IE23S_A.productsTable.find('.preloader').hide();
        },
        runSearch: function (q) {
            if (this.ajaxSearching != null)
                this.ajaxSearching.abort();
            this.productsTable.find('.preloader').show();
            this.productsTable.find('tbody').html('');

            this.ajaxSearching = $.ajax({
                type: 'GET',
                url: '/api/products',
                dataType: 'json',
                data: 'q=' + q,
                success: this.successSearch,
                error: function () {
                    IE23S_A.isSearching = false;
                }

            });

        },
        search: function (e) {
            e.on("input", function () {
                IE23S_A.runSearch($(this).val());
            });
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
        onEdit: function (event) {
            event.preventDefault();
            $.ajax({
                type: 'PUT',
                url: '/api/product',
                dataType: 'json',
                beforeSend: () => this.block(),
                data: this.modalForm.serialize(),
                success: this.successEdited,
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
        productRemove: function (id) {
            $.ajax({
                type: 'DELETE',
                url: '/api/product',
                dataType: 'json',
                beforeSend: () => this.block(),
                data: 'id=' + id,
                success: function () {
                    M.toast({html: 'Product removed!'});
                    IE23S_A.runSearch('');
                },
                error: function (e) {
                    let errorMessage = 'There was a problem with the request, please try again';
                    if (e.responseJSON && e.responseJSON.text) {
                        errorMessage = e.responseJSON.text;
                    }
                    M.toast(errorMessage)
                }

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
            this.isEdit = false;
            this.change_button('create');
            this.openForm();
            this.modalElement.find('button[name="cancel"]').click(() => this.modal.close());
        },
        productEditForm: function (e) {
            this.isEdit = true;
            this.change_button('edit');
            this.openForm();
            this.block();
            this.editLoad(e);
            this.modalElement.find('button[name="cancel"]').click(() => this.modal.close());
        },
        initCreate: function (e) {
            e.click(() => IE23S_A.product_add());
            this.modalForm.submit(function (e) {
                e.preventDefault();

                if (IE23S_A.isEdit) {
                    IE23S_A.onEdit(e)
                } else {

                    IE23S_A.onAdd(e);
                }
            });
        },
        initEdit: function (e) {
            e.click(function () {
                IE23S_A.productEditForm($(this).attr('data-id'));
            });
        },
        initRemove: function (e) {
            e.click(function () {
                IE23S_A.productRemove($(this).attr('data-id'));
            });
        }
    }
    IE23S_A.initCreate($('.create-product'));
    IE23S_A.initEdit($('.product-edit'));
    IE23S_A.initRemove($('.product-remove'));
    IE23S_A.search($('#adm-products-search').find('input'));
});
