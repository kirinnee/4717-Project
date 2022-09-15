{ nixpkgs ? import <nixpkgs> { } }:
let env = import ./env.nix { inherit nixpkgs; }; in
{
  dev = nixpkgs.mkShell {
    buildInputs = env.system ++ env.main ++ env.dev ++ env.lint ++ [ ];
  };
  ci = nixpkgs.mkShell {
    buildInputs = env.system ++ env.main ++ env.lint ++ [ ];
  };
}
