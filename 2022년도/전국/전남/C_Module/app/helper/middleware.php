<?php 
  function notUser() {
    err(@USER, "back", "로그인한 회원은 접근 할 수 없습니다.");
  }

  function isUser() {
    err(!@USER, "back", "로그인한 회원만 접근 가능합니다.");
  }

  function admin() {
    err(@!USER['type'] != "garden", "back", "관리자만 접근 가능한 페이지입니다.");
  }
?>