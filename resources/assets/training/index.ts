import "@babel/polyfill";
import "smooth-submit";
import "bootstrap";
import {$crud} from "./crud";
import $ from "jquery";
import * as toastr from 'toastr';
import swal, {SweetAlertOptions} from 'sweetalert2';
import {AssignPlayers} from "./assign-players";
import {AssignChatroom} from "./assign-chatroom";
import * as ReactDOM from "react-dom";
import * as React from "react";
import Event = JQuery.Event;
import {Simulate} from "react-dom/test-utils";
import select = Simulate.select;
import * as moment from "moment-timezone";
import ChangeEvent = JQuery.ChangeEvent;
//import {cronj} from "node-cron";

// var cron = require('node-cron');
//
// cron.schedule('*/2 * * * * *', () => {
//     $crud.create("chat-room-notification", {
//         group_id: 3,
//         text: 'test message',
//         user: 'test2'
//     },{
//         notify:false
//     })
//     console.log('running a task every minute');
// });

const refresh = selector => {
    $.get(window.location.href, data => {
        $(selector).replaceWith($(data).find(selector));
    }, 'html')
}



$.crud().$config.callbacks.notify = (data) => new Promise(resolve => {
    toastr[data.type](data.message);
})

$.crud().$config.callbacks.redirect = (url) => window.location.href = url;

$.crud().$config.callbacks.confirm = (options: SweetAlertOptions) => new Promise((resolve, reject) => {
    swal({
        title: "Are you sure?",
        text: 'You won\'t be able to revert this!',
        type: "warning",
        showCancelButton: true,
        ...options,
    }).then(data => data.dismiss ? reject(data) : resolve(data))
})

$.crud().$config.callbacks.reload = () => {
    window.location.reload();
}

let timezone = moment.tz.guess()
if (timezone !== $timezone) {
    $.crud().update("timezone", {
        timezone: moment.tz.guess()
    }).then(() => window.location.reload())
}

$.smoothSubmitConfig({
    crudOptions: {
        notify: true,
        checkDataType: true
    }
})

$("#login").smoothSubmit({
    crudOptions: {
        notify: true,
        checkDataType: true,
        reload: true
    }
})

$('.logout-btn').smoothSubmit({
    crudOptions: {
        notify: true,
        checkDataType: true,
        reload: true
    }
})

// Player Script

$('#create_player').smoothSubmit({
    crudOptions: {
        notify: true,
        checkDataType: true,
        reload: true
    }
})


$('.delete-player').smoothSubmit({
    preConfirm: () => $.crud().confirm({}),
    crudOptions: {
        checkDataType: true,
        notify: true
    },
    type: "post"
}).on('aftersubmit', function (e, data) {
    $(this).parents('tr').remove();
})

$("#edit_player").smoothSubmit({
    crudOptions: {
        notify: true,
        checkDataType: true,
        redirectTo: "admin/players"
    }
})

// player script

// chat group script
$("#create-chat-rooms").smoothSubmit({
    crudOptions: {
        notify: true,
        checkDataType: true,
        redirectTo: 'admin/chat-room'
    }
})

$('.delete-chat-rooms').smoothSubmit({
    preConfirm: () => $.crud().confirm({}),
    crudOptions: {
        checkDataType: true,
        notify: true
    },
    type: "post"
}).on('aftersubmit', function (e, data) {
    $(this).parents('tr').remove();
})

$("#edit-chat-rooms").smoothSubmit({
    crudOptions: {
        notify: true,
        checkDataType: true,
        redirectTo: 'admin/chat-room'
    }
})


// Groups Script
$("#create-group").smoothSubmit({
    crudOptions: {
        notify: true,
        checkDataType: true,
        redirectTo: 'admin/groups'
    }
})

$("#edit-group").smoothSubmit({
    crudOptions: {
        notify: true,
        checkDataType: true,
        redirectTo: 'admin/groups'
    }
})

$(".delete-group").smoothSubmit({
    preConfirm: () => $.crud().confirm({}),
}).on('aftersubmit', (e, data) => {
    $(this).parents('.groups-card').remove();
})

// Groups Script

// coupon script
$("#create-coupon").smoothSubmit({
    crudOptions: {
        notify: true,
        checkDataType: true,
        redirectTo: 'admin/coupon'
    }
})

$("#edit-coupon").smoothSubmit({
    crudOptions: {
        notify: true,
        checkDataType: true,
        redirectTo: 'admin/coupon'
    }
})

$('.delete-coupon').smoothSubmit({
    preConfirm: () => $.crud().confirm({}),
    crudOptions: {
        checkDataType: true,
        notify: true
    },
    type: "post"
}).on('aftersubmit', function (e, data) {
    $(this).parents('tr').remove();
})

// event script
$("#create-event").smoothSubmit({
    crudOptions: {
        notify: true,
        checkDataType: true,
        redirectTo: 'admin/event'
    }
})

$("#edit-event").smoothSubmit({
    crudOptions: {
        notify: true,
        checkDataType: true,
        redirectTo: 'admin/event'
    }
})

$('.delete-event').smoothSubmit({
    preConfirm: () => $.crud().confirm({}),
    crudOptions: {
        checkDataType: true,
        notify: true,
        reload:true
    },
    type: "post"
}).on('aftersubmit', function (e, data) {
    $(this).parents('tr').remove();
})

$("#update-event").smoothSubmit({
    crudOptions: {
        notify: true,
        checkDataType: true,
        redirectTo: 'admin/event'
    }
})


// video created

$("#create-video").smoothSubmit({
    crudOptions: {
        notify: true,
        checkDataType: true,
        redirectTo: 'admin/video'
    }
})

$('.delete-video').smoothSubmit({
    preConfirm: () => $.crud().confirm({}),
    crudOptions: {
        checkDataType: true,
        notify: true,
        reload:true
    },
    type: "post"
}).on('aftersubmit', function (e, data) {
    $(this).parents('tr').remove();
})

$("#update-video").smoothSubmit({
    crudOptions: {
        notify: true,
        checkDataType: true,
        redirectTo: 'admin/video'
    }
})


// Sports Script

$("#add-sport").smoothSubmit({
    crudOptions: {
        notify: true,
        checkDataType: true,
        reload: true
    }
}).on('aftersubmit', function (e, data) {
    $('#create-sport').trigger('reset');
    $('#create-sport').modal('hide');
})

$(".delete-sport").smoothSubmit({
    preConfirm: () => $.crud().confirm({}),
}).on('aftersubmit', function (e, data) {
    $(this).parents('li').remove();
})


$(".get-sport").on('click', function () {
    const id = $(this).attr('sport_id');
    $.crud().retrieve("sport", {id}).then(({sport}) => {
        console.log(sport.name)
        if ((sport.icon.url) != null) {
            $('#get_icon_preview').attr('src', sport.icon.url);
        }
        $("#get_sport_id").val(sport.id);
        $("#get_sport_name").val(sport.name)
    })
})


$("#update-sport").smoothSubmit({
    crudOptions: {
        notify: true,
        checkDataType: true,
        reload: true
    }
}).on('aftersubmit', () => {
    $('#update-sport').trigger('reset');
    $('#update-sport').modal('hide');
    location.reload();
})

$("#create-training").smoothSubmit({
    crudOptions: {
        notify: true,
        checkDataType: true,
        redirectTo: 'admin/trainings'
    }
})
$("#update-training").smoothSubmit({
    crudOptions: {
        notify: true,
        checkDataType: true,
        redirectTo: 'admin/trainings'
    }
})

$(".delete-training").smoothSubmit({
    crudOptions: {
        notify: true,
        checkDataType: true,
        reload: true
    },
    preConfirm: () => $.crud().confirm({}),
    type: "post"
})

$("#create-message").smoothSubmit({
    crudOptions: {
        notify: true,
        checkDataType: true,
        redirectTo: 'admin/messages'
    }
})
$("#update-message").smoothSubmit({
    crudOptions: {
        notify: true,
        checkDataType: true,
        redirectTo: 'admin/messages'
    }
})
$("#update-profile").smoothSubmit({
    crudOptions: {
        notify: true,
        checkDataType: true,
        reload: true
    }
})
$("#update-password").smoothSubmit({
    crudOptions: {
        notify: true,
        checkDataType: true,
        reload: true
    }
})

$(".delete-message").smoothSubmit({
    preConfirm: () => $.crud().confirm({}),
}).on('aftersubmit', (e, data) => {
    $(e.target).parents('tr').remove();
})

$(".switch-payment").on("change", (e:ChangeEvent) => {
    const player_id = e.target.dataset.playerId;
    if (e.target.checked) {
        $crud.create("payment", {
            player_id: player_id
        }).then(() => refresh(`#player-status-${player_id}`))
    } else {
        $crud.delete("payment", {
            player_id: player_id
        }).then(() => refresh(`#player-status-${player_id}`))
    }
})

$(".couponSwitchToggle").on("change", (e:ChangeEvent) => {
    const coupon_id = e.target.dataset.couponId;
    if (e.target.checked) {
        $crud.update("coupon_status", {
            coupon_id: coupon_id
        }).then(() => refresh(`#player-status-${coupon_id}`))
    } else {
        $crud.update("coupon_status", {
            coupon_id: coupon_id
        }).then(() => refresh(`#player-status-${coupon_id}`))
    }
})

$('.sortable').sortable({
    stop: function (event, ui) {
        var data = $('.sortable').sortable("toArray");
        console.log(data)
    }
});

if (document.querySelector("#assign-players")) {
    ReactDOM.render(React.createElement(AssignPlayers), document.querySelector("#assign-players"))
}

if (document.querySelector("#assign-chatroom")) {
    ReactDOM.render(React.createElement(AssignChatroom), document.querySelector("#assign-chatroom"))
}
