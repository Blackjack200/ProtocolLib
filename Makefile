PHP_BUILD_PLUGIN=`which grpc_php_plugin`
GO_BUILD_PLUGIN=`which protoc-gen-go-grpc`

php:
	@mkdir -p php_client/src
	@rm -rdf php_client/src
	@mkdir -p php_client/src
	@protoc --plugin=protoc-gen-grpc=$(PHP_BUILD_PLUGIN) proto/*.proto --php_out="php_client/src" --grpc_out="php_client/src"

go:
	@mkdir -p go_out
	@protoc --plugin=protoc-gen-grpc=$(GO_BUILD_PLUGIN) proto/*.proto --go_out="go_out" --grpc_out="go_out"
