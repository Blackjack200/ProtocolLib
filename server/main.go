package main

import (
	"flag"
	"fmt"
	"github.com/blackjack200/protocol-lib/proto"
	"github.com/blackjack200/protocol-lib/service"
	"google.golang.org/grpc"
	"log"
	"net"
)

func main() {
	flag.Parse()
	lis, err := net.Listen("tcp", fmt.Sprintf("localhost:%d", 8888))
	if err != nil {
		log.Fatalf("failed to listen: %v", err)
	}
	var opts []grpc.ServerOption
	s := grpc.NewServer(opts...)
	proto.RegisterTrackerServer(s, service.NewTracker())
	if err := s.Serve(lis); err != nil {
		panic(err)
	}
}
