"use strict";

jQuery(document).ready(function ($) {
    // Get the current URL (without query parameters)
    let currentUrlForMenu = window.location.href.split("?")[0];
    console.log(currentUrlForMenu);

    // Loop through each .nav-item
    $(".nav-item").each(function () {
        // Get the href attribute and remove any query parameters from it
        let linkHref = $(this).find("a").attr("href").split("?")[0];

        // Check if the href attribute of the link matches the current URL
        if (linkHref === currentUrlForMenu) {
            $(this).addClass("active"); // Add the active class to the matched link
        }
    });

    // Optional: Highlight the active link when clicked (this will remove the active class from all links and add it to the clicked link)
    $(".nav-item").on("click", function () {
        $(".nav-item").removeClass("active"); // Remove active class from all links
        $(this).addClass("active"); // Add active class to the clicked link
    });
});

// Cicle Chart
Circles.create({
    id: "task-complete",
    radius: 50,
    value: 80,
    maxValue: 100,
    width: 5,
    text: function (value) {
        return value + "%";
    },
    colors: ["#36a3f7", "#fff"],
    duration: 400,
    wrpClass: "circles-wrp",
    textClass: "circles-text",
    styleWrapper: true,
    styleText: true,
});

//Notify
// $.notify({
// 	icon: 'icon-bell',
// 	title: 'Kaiadmin',
// 	message: 'Premium Bootstrap 5 Admin Dashboard',
// },{
// 	type: 'secondary',
// 	placement: {
// 		from: "bottom",
// 		align: "right"
// 	},
// 	time: 1000,
// });

$("#activeUsersChart").sparkline(
    [112, 109, 120, 107, 110, 85, 87, 90, 102, 109, 120, 99, 110, 85, 87, 94],
    {
        type: "bar",
        height: "100",
        barWidth: 9,
        barSpacing: 10,
        barColor: "rgba(255,255,255,.3)",
    }
);

// $(document).ready(function () {
//     $("select").niceSelect();
// });
