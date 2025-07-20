(function (wp, $) {
    'use strict';

    wp.customize.bind('ready', function () {

        // Get the IDs of all our settings from the data passed by PHP.
        const settingIds = forgepress_reset_data.setting_ids;

        // Find the placeholder control we created.
        const control = wp.customize.control('forgepress_reset_button_control');

        if (!control) {
            return;
        }

        // Create our actual button.
        const button = $('<button class="button button-primary button-large">Reset All ForgePress Options</button>');

        // Replace the placeholder content with our new button.
        control.container.find('.customize-control-content').empty().append(button);

        // Add the click event listener.
        button.on('click', function (e) {
            e.preventDefault();

            // Ask for confirmation.
            const isConfirmed = window.confirm('Are you sure you want to reset all ForgePress options to their defaults? This cannot be undone.');

            if (!isConfirmed) {
                return;
            }

            // Loop through each of our settings.
            settingIds.forEach(function (settingId) {
                const setting = wp.customize(settingId);
                if (setting) {
                    // Reset the setting to its default value.
                    setting.set(setting.defaultValue);
                }
            });

            // Show a visual feedback flash on the panel.
            control.section.instance.container.find('.accordion-section-title').trigger('click').addClass('flash');
            setTimeout(function () {
                control.section.instance.container.find('.accordion-section-title').removeClass('flash');
            }, 500);
        });
    });

})(window.wp, jQuery);