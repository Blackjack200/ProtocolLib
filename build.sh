rm -rdf out
mkdir out
mkdir out/go
mkdir out/php
protoc --proto_path=proto --php_out=out/php --go_out=out/go --go-grpc_out=out/go proto/*.proto