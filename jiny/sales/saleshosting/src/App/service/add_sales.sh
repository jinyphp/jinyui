#!/bin/bash
if [ ! -d "../../$1" ]; then
  mkdir ../../$1
  mkdir ../../$1/theme
  mkdir ../../$1/images
  mkdir ../../$1/goods
  mkdir ../../$1/orders
  mkdir ../../$1/gallary
  mkdir ../../$1/board
  mkdir ../../$1/curl
  mkdir ../../$1/conf
  mkdir ../../$1/func
  mkdir ../../$1/js
  mkdir ../../$1/css
  mkdir ../../$1/sales
fi

cp ../*.php ../../$1
cp ../js/* ../../$1/js
cp ../css/* ../../$1/css
cp ../func/* ../../$1/func
cp ../sales/curl_* ../../$1/sales
cp ../theme/curl_* ../../$1/theme

