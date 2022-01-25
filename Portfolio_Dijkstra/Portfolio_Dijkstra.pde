void setup(){
  /*
  インスタンスの形式は以下とする．
  -----------
  グラフ上の頂点数
  辺0が出ていく頂点のインデックス，辺0が入る頂点のインデックス，辺0の重み
  ...
  辺n-1が出ていく頂点のインデックス，辺n-1が入る頂点のインデックス，辺n-1の重み
  -----------
  全ての辺の重みが 0 以上であることを仮定する ( = 負の重みを許すと，ダイクストラ法では解けない )
  また，重み付き有向グラフと仮定する
  */
  String[] data = {
    "4",
    "0,1,2",
    "0,2,4",
    "1,2,1",
    "1,3,4",
    "2,3,1"
  };
  Graph graph = new Graph( data );
  println( "頂点 0 から 頂点 3 までの最短距離： "+ graph.dijkstra( graph.ns.get( 0 ), graph.ns.get( 3 ) ) );
}
