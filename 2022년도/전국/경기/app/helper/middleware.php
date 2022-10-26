<?php 
  function notUser() {
    err(@USER, "back", "로그인한 회원은 접근할 수 없습니다.");
  }

  function isUser() {
    err(!@USER, "back", "로그인한 회원만 접근 가능합니다.");
  }

  function norUser() {
    err(@USER['type'] != "normal", "back", "로그인한 일반회원만 접근 가능합니다.");
  }

  function isAdmin() {
    err(@USER['type'] != "admin" && @USER['type'] != "manager", "back", "로그인한 관리자 회원만 접근 가능한 페이지입니다.");
  }
?>