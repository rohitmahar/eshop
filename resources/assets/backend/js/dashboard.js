/*
 * Author: Abdullah A Almsaeed
 * Date: 4 Jan 2014
 * Description:
 *      This is a demo file used only for the main dashboard (index.html)
 **/

$(function () {

  "use strict";

  //jvectormap data

  //Fix for charts under tabs
  $('.box ul.nav a').on('shown.bs.tab', function () {
    area.redraw();
    donut.redraw();
    line.redraw();
  });

  /* The todo list plugin */
  $(".todo-list").todolist({
    onCheck: function (ele) {
      window.console.log("The element has been checked");
      return ele;
    },
    onUncheck: function (ele) {
      window.console.log("The element has been unchecked");
      return ele;
    }
  });

  $('.product-image-button').change(function () {
    for (let i=0, len = this.files.length; i < len; i++) {
      (function (j, self) {
        var reader = new FileReader();
        $('ul.showImageName').empty();
        reader.onload = function (e) {
          setTimeout(() => {
              $('ul.showImageName').append('<li>' + self.files[j].name + '</li>');
          }, 500);
        }
        reader.readAsDataURL(self.files[j])
        })(i, this);
      }
    });
});
