var current = 0;
var tabs = $(".tab");
var tabs_pill = $(".tab-pills");

loadFormData(current);

function loadFormData(n) {
	$(tabs_pill[n]).addClass("active");
  $(tabs[n]).removeClass("d-none");
  $("#back_button").attr("disabled", n == 0 ? true : false);
  n == tabs.length - 1
    ? $("#next_button").text("যুক্ত করুন").attr("onclick", "submit()")
    : $("#next_button").attr("type", "button").text("সামনে যান").attr("onclick", "next()");
}


function next() {
  $(tabs[current]).addClass("d-none");
  $(tabs_pill[current]).removeClass("active");

  current++;
  loadFormData(current);
}

function back() {
  $(tabs[current]).addClass("d-none");
  $(tabs_pill[current]).removeClass("active");

  current--;
  loadFormData(current);
}

function submit(){
  $("#next_button").attr("type", "submit");
}




