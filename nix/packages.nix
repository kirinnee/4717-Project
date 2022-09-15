{ nixpkgs ? import <nixpkgs> { } }:
let
  pkgs = rec {
    atomi = (
      with import (fetchTarball "https://github.com/kirinnee/test-nix-repo/archive/refs/tags/v9.2.0.tar.gz");
      {
        inherit pls;
      }
    );
    "Unstable 26th Aug 2022" = (
      with import (fetchTarball "https://github.com/NixOS/nixpkgs/archive/03428dbaaa23d6bf458770907b0927b377c873a8.tar.gz") { };
      {
        inherit
          hadolint
          docker
          pre-commit
          coreutils
          gnugrep
          jq
          nixpkgs-fmt
          shfmt
          shellcheck;
        prettier = nodePackages.prettier;
        browser-sync = nodePackages.browser-sync;
      }
    );
  };
in
with pkgs;
pkgs.atomi // pkgs."Unstable 26th Aug 2022"
