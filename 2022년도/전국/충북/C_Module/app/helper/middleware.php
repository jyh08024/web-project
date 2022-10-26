<?php
  function isUser() {
    err(!@USER, "/", "로그인한 회원만 접근가능합니다.");
  }

  function isAdmin() {
    err(@USER['type'] != "admin", "back", "과리자만 접근 가능합니다.");
  }
?>