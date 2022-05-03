(function ($) {

    var WpReferKeywordPlannerManager = {
        init: function () {
            this.cacheDom();
            this.bind();
        },

        cacheDom: function () {
            this.$keywordPlannerWrapper = $('.wprefers-keyword-generator-wrapper');
            this.generateBtn  = this.$keywordPlannerWrapper.find('#wprefers-generator');
            this.copyBtn  = this.$keywordPlannerWrapper.find('.wprefers-keyword-generator-btn-cp-clipboard');
            this.clearBtn  = this.$keywordPlannerWrapper.find('.wprefers-keyword-generator-btn-clear');
            this.keywordTextArea  = this.$keywordPlannerWrapper.find('textarea#wprefers-selected-keywords');
        },

        bind: function () {
            this.generateBtn.on('click', this.xhr);
            this.copyBtn.on('click', this.copy);
            this.clearBtn.on('click', this.clear);
            this.$keywordPlannerWrapper.on('click', 'li', this.copyKeyword);
        },

        xhr: function (e) {
            e.preventDefault()

            var $this = $(this),
                countryQueryElement = $('select[name=wprefers-country]'),
                keywordQueryElement = $('input[name=wprefers-keyword]');

            // Check input validation
            if (!keywordQueryElement[0].checkValidity()) {
                keywordQueryElement.siblings('.wprefers-error').show()
                $this.prop('disabled', false);
                return false;
            } else {
                keywordQueryElement.siblings('.wprefers-error').hide()
            }

            $this.prop('disabled', true);

            var countryQuery = countryQueryElement.val().split('-')

            $.ajax({
                url: wprefers_kg_script_data.ajaxurl,
                type: 'POST',
                data: {
                    action: wprefers_kg_script_data.action,
                    security: wprefers_kg_script_data.security,
                    county: countryQuery[0],
                    language: countryQuery[1],
                    keyword: keywordQueryElement.val()
                },
                success: function (response) {
                    WpReferKeywordPlannerManager.$keywordPlannerWrapper.find('ul').html(
                        response.html
                    )
                    WpReferKeywordPlannerManager.$keywordPlannerWrapper
                        .find('.wprefers-keyword-generator-total-keywords').html( response.total )
                    $this.prop('disabled', false);
                }
            });
        },

        copy: function (e) {
            e.preventDefault();
            var copyText = $(this).parents('tr').find('textarea#wprefers-selected-keywords')
            copyText.select();
            document.execCommand("copy");
        },

        clear: function (e) {
            e.preventDefault();
            $(this).parents('tr').find('textarea#wprefers-selected-keywords').val('')

            $.each(WpReferKeywordPlannerManager.$keywordPlannerWrapper.find('li'), function() {
                $(this).removeClass('selected')
            });

            WpReferKeywordPlannerManager.$keywordPlannerWrapper.find('.wprefers-keyword-generator-total-keywords-selected').html('0')
        },

        copyKeyword: function () {
            var $this = $(this),
                $textarea = WpReferKeywordPlannerManager.keywordTextArea,
                selectedKeyword;

            if ($this.hasClass('selected')) {
                $this.removeClass('selected');
                selectedKeyword = $textarea.val()
                    .replace($this.data('keyword'), '')
            } else {
                $this.addClass('selected');

                if ($textarea.val() === '') {
                    selectedKeyword = $this.data('keyword')
                } else {
                    selectedKeyword = $textarea.val() + '\n' + $this.data('keyword')
                }
            }

            $textarea.val(
                selectedKeyword
            )

            WpReferKeywordPlannerManager.$keywordPlannerWrapper.find('.wprefers-keyword-generator-total-keywords-selected').html(
                WpReferKeywordPlannerManager.$keywordPlannerWrapper.find('li.selected').length
            )
        }
    }
    WpReferKeywordPlannerManager.init();
}) (jQuery);