PHP_BUILD_PLUGIN=`which grpc_php_plugin`
GO_BUILD_PLUGIN=`which protoc-gen-go-grpc`

PHP_OUT="php_client/src"
GO_OUT="server/proto"

php:
	@mkdir -p $(PHP_OUT)
	@rm -rdf $(PHP_OUT)
	@mkdir -p $(PHP_OUT)
	@protoc --plugin=protoc-gen-grpc=$(PHP_BUILD_PLUGIN) proto/*.proto --php_out="$(PHP_OUT)" --grpc_out="$(PHP_OUT)"

go:
	@mkdir -p $(GO_OUT)
	@rm -rdf $(GO_OUT)
	@mkdir -p $(GO_OUT)
	@protoc --plugin=protoc-gen-grpc=$(GO_BUILD_PLUGIN) proto/*.proto --go_out="$(GO_OUT)" --grpc_out="$(GO_OUT)"

all:
	@make php
	@make go