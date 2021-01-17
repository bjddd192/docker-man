FROM golang:1.13-alpine AS build

RUN apk add --update zstd-static zstd-dev make gcc musl-dev git
RUN go get golang.org/x/lint/golint
RUN mkdir -p /go/src/github.com/Vertamedia \
	&& cd /go/src/github.com/Vertamedia \
	&& git clone https://github.com/Vertamedia/chproxy.git \
	&& cd /go/src/github.com/Vertamedia/chproxy \
	&& git checkout -b release_v1.14.0 v1.14.0
WORKDIR /go/src/github.com/Vertamedia/chproxy
RUN make release-build

FROM alpine
MAINTAINER bjddd192 <bjddd192@163.com>
COPY --from=build /go/src/github.com/Vertamedia/chproxy/chproxy /chproxy
ENTRYPOINT [ "/chproxy" ]
CMD [ "--help" ]
