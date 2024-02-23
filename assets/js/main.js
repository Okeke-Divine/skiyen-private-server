const __setDocumentTitle = (title) => {
  document.title = title + " | Private Server | Skiyen";
};

const _el = (type, el) => {
  if (type === "id") {
    return document.getElementById(el);
  } else if (type === "qs") {
    return document.querySelector(el);
  }
  return document.getElementById(el);
};

function toggleLogin_passwordView() {
  var password = _el("id", "password");

  if (password.getAttribute("type") === "password") {
    password.setAttribute("type", "text");
    _el("qs", ".login_passwordViewToggle span i").classList.remove("la-eye");
    _el("qs", ".login_passwordViewToggle span i").classList.add("la-eye-slash");
  } else {
    password.setAttribute("type", "password");
    _el("qs", ".login_passwordViewToggle span i").classList.remove(
      "la-eye-slash"
    );
    _el("qs", ".login_passwordViewToggle span i").classList.add("la-eye");
  }
}

function _goto(url) {
  return (window.location = url);
}

function logout() {
  swal({
    title: "Are you sure you want to logout?",
    icon: "info",
    buttons: ["No", "Yes"],
    dangerMode: false,
  }).then(function (isConfirm) {
    if (isConfirm === true) {
      _goto("/logout");
    }
  });
}

function throwSwalError1() {
  swal({
    icon: "error",
    title: "An error just occured.",
    text: "Just rest! You are disturbing me!!! 😩😩",
    button: "Ok! Sorry Sir. No vex abeg.🙏",
  });
}

function throwSwal404orNotReady() {
  swal({
    icon: "warning",
    title: "🙄🙄👀",
    text: "Either a 404 error occured or the... em.. em... feature is not ready. So just rest! Rest Abeg!",
    button: "Okay Sir! 😶",
  });
}

function rightDivPageCont(url) {
  _el("id", "pageLoaderOverlay").style.display = "flex";
  const right_page_content = _el("id", "right_page_content");
  const isViewing = right_page_content.getAttribute("data-isViewing");
  if (isViewing !== url) {
    console.log(url);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState === 4) {
        if (this.status === 200) {
          right_page_content.setAttribute("data-isViewing", url);
          _el("id", "right_page_content").innerHTML = this.responseText;
        } else {
          throwSwalError1();
        }
      }
      _el("id", "pageLoaderOverlay").style.display = "none";
    };
    xhttp.open("GET", url, true);
    xhttp.send();
  }
}

function fetchPageContent(url, place) {
  _el("id", "pageLoaderOverlay").style.display = "flex";
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if ((this.readyState === 4) & (this.status === 200)) {
      if (place === "main") {
        _el("id", "main_page_content").innerHTML = this.responseText;
      } else if (place === "right") {
        _el("id", "right_page_content").innerHTML = this.responseText;
      }
    } else {
      if (this.readyState === 4) {
        throwSwalError1();
      }
    }
    _el("id", "pageLoaderOverlay").style.display = "none";
  };
  xhttp.open("GET", url, true);
  xhttp.send();
}

function rewriteUrl(url) {
  history.pushState({ foo: "bar" }, "", url);
}

function rewriteTilte(page) {
  page = page.toLowerCase();
  if (page === "home") {
    __setDocumentTitle("Home");
  } else if (page === "messages") {
    __setDocumentTitle("Messages");
  } else if (page === "notifications") {
    __setDocumentTitle("Notifications");
  } else if (page === "profile") {
    __setDocumentTitle("Profile");
  } else if (page === "settings") {
    __setDocumentTitle("Settings");
  } else {
    __setDocumentTitle("404 Not Found");
  }
}

function loadPage(page) {
  page = page.toLowerCase();
  lastActivity();
  rewriteUrl("/?p=" + page);
  rewriteTilte(page);
  if (page === "home") {
    fetchPageContent("/axP/home", "main");
    rightDivPageCont("/right_content1");
  } else if (page === "messages") {
    fetchPageContent("/axP/messages", "main");
    rightDivPageCont("/right_content1");
  } else if (page === "profile") {
    fetchPageContent("/axP/myprofile", "main");
    rightDivPageCont("/right_content1");
  } else {
    throwSwal404orNotReady();
    rightDivPageCont("/right_content1");
  }
}

function load_chat_with(publicKey) {
  var chat_overlay = _el("id", "chat_overlay");
  var chat_iframe = _el("id", "chat_iframe");
  chat_iframe.setAttribute(
    "src",
    "/standalone_page/chat_with?publicKey=" + publicKey
  );
  chat_overlay.style.display = "flex";
}

function close_chat_overlay() {
  var chat_overlay = _el("id", "chat_overlay");
  chat_overlay.style.display = "none";
  var chat_iframe = _el("id", "chat_iframe");
  chat_iframe.setAttribute("src", "");
}

function ui_sidebarExpand_toogle() {
  var ui_sidebar_1 = _el("id", "ui_sidebar_1");
  if (ui_sidebar_1.getAttribute("data-isExpanded") == "false") {
    ui_sidebar_1.style.left = "0px";
    ui_sidebar_1.setAttribute("data-isExpanded", "true");
  } else {
    ui_sidebar_1.style.left = "-100%";
    ui_sidebar_1.setAttribute("data-isExpanded", "false");
  }
}

function lastSeen() {
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "/ax/last_seen", true);
  xhttp.send();
}

function lastActivity() {
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "/ax/last_activity", true);
  xhttp.send();
}

function toggleFullScreen() {
  const fullScreenToggle_controller = _el("id", "fullScreenToggle_controller");
  const isFullScreen =
    fullScreenToggle_controller.getAttribute("data-isFullScreen");
  var shouldMakeFullScreen = _el("qs", "html");

  if (isFullScreen == "false") {
    if (shouldMakeFullScreen.requestFullscreen) {
      shouldMakeFullScreen.requestFullscreen();
    } else if (shouldMakeFullScreen.webkitRequestFullscreen) {
      /* Safari */
      shouldMakeFullScreen.webkitRequestFullscreen();
    } else if (shouldMakeFullScreen.msRequestFullscreen) {
      /* IE11 */
      shouldMakeFullScreen.msRequestFullscreen();
    }
    fullScreenToggle_controller.setAttribute("data-isFullScreen", "true");
    _el("qs", "#fullScreenToggle_controller i").setAttribute(
      "class",
      "las la-compress"
    );
  } else {
    fullScreenToggle_controller.setAttribute("data-isFullScreen", "false");
    _el("qs", "#fullScreenToggle_controller i").setAttribute(
      "class",
      "las la-expand"
    );
    closeFullscreen();
  }
}

function closeFullscreen() {
  if (document.exitFullscreen) {
    document.exitFullscreen();
  } else if (document.webkitExitFullscreen) {
    /* Safari */
    document.webkitExitFullscreen();
  } else if (document.msExitFullscreen) {
    /* IE11 */
    document.msExitFullscreen();
  }
}
