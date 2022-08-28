PHP_BUILD_PLUGIN=`which grpc_php_plugin`
GO_BUILD_PLUGIN=`which protoc-gen-go-grpc`

PHP_PROTO_OUT="php_client/src"
GO_PROTO_OUT="server"
GO_BIN_NAME="protocol_lib_server"

proto_php:
	@mkdir -p $(PHP_PROTO_OUT)/GPBMetadata
	@mkdir -p $(PHP_PROTO_OUT)/prokits/protocol
	@rm -rdf $(PHP_PROTO_OUT)/GPBMetadata
	@rm -rdf $(PHP_PROTO_OUT)/prokits/protocol
	@mkdir -p $(PHP_PROTO_OUT)/GPBMetadata
	@mkdir -p $(PHP_PROTO_OUT)/prokits/protocol
	@protoc --plugin=protoc-gen-grpc=$(PHP_BUILD_PLUGIN) proto/*.proto --php_out="$(PHP_PROTO_OUT)" --grpc_out="$(PHP_PROTO_OUT)"

proto_go:
	@rm -rdf $(GO_PROTO_OUT)/proto
	@mkdir -p $(GO_PROTO_OUT)
	@protoc --plugin=protoc-gen-grpc=$(GO_BUILD_PLUGIN) proto/*.proto --go_out="$(GO_PROTO_OUT)" --grpc_out="$(GO_PROTO_OUT)"

bin_go:
	@cd server && go build -ldflags="-w -s" -o "../$(GO_BIN_NAME)" main.go
all:
	@make proto_php
	@make proto_go
	@make bin_go