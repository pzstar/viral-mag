jQuery(document).ready(function ($) {
    $("body").on("click", ".viral-mag-switch-section.viral-mag-switch", function () {
        var controlName = $(this).siblings("input").data("customize-setting-link");
        var controlValue = $(this).siblings("input").val();
        var iconClass = "dashicons-visibility";
        if (controlValue === "off") {
            iconClass = "dashicons-hidden";
            $("[data-control=" + controlName + "]")
                    .parent()
                    .addClass("viral-mag-section-hidden")
                    .removeClass("viral-mag-section-visible");
        } else {
            $("[data-control=" + controlName + "]")
                    .parent()
                    .addClass("viral-mag-section-visible")
                    .removeClass("viral-mag-section-hidden");
        }
        $("[data-control=" + controlName + "]")
                .children()
                .attr("class", "dashicons " + iconClass);
    });
});
