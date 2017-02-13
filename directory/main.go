package main

import (
  "path/filepath"
  "os"
  "flag"
  "fmt"
  "time"
)

func visit(path string, f os.FileInfo, err error) error {
  fmt.Printf("Visited: %s\n", path)
  return nil
} 


func main() {
    start := time.Now()
    flag.Parse()
    root := flag.Arg(0)
    err := filepath.Walk(root, visit)
    elapsed := time.Since(start)
    fmt.Printf("filepath.Walk() returned %v\n", err)
    fmt.Println("Time: ", elapsed)

}