{ nixpkgs ? import <nixpkgs> { } }:
let pkgs = import ./packages.nix { inherit nixpkgs; }; in
with pkgs;
{
  system = [
    coreutils
    gnugrep
    jq
    docker
  ];

  main = [
    pls
    browser-sync
  ];

  dev = [
  ];

  lint = [
    hadolint
    pre-commit
    nixpkgs-fmt
    prettier
    shfmt
    shellcheck
  ];

}
